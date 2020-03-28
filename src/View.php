<?php

namespace App;

use Psr\Http\Message\ResponseInterface;

class View
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $layout;

    /**
     * View constructor.
     *
     * @param string $templatePath
     * @param array $attributes
     * @param string $layout
     */
    public function __construct(string $templatePath = '', array $attributes = [], string $layout = '')
    {
        $this->setTemplatePath($templatePath);
        $this->setAttributes($attributes);
        $this->setLayout($layout);
    }

    /**
     * Render a template
     *
     * $data cannot contain template as a key
     *
     * @param ResponseInterface $response
     * @param string $template
     * @param array|mixed $data
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException if $templatePath . $template does not exist
     * @throws \Throwable
     */
    public function render(ResponseInterface $response, string $template, $data = []): ResponseInterface
    {
        $output = $this->fetch($template, $data);
        if ($this->layout) {
            $data = (array)$data;
            $data['content'] = $output;
            $output = $this->fetch($this->layout, $data);
        }
        $response->getBody()->write($output);
        return $response;
    }

    /**
     * Get layout template
     *
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * Set layout template
     *
     * @param string $layout
     * @return View
     */
    public function setLayout($layout = ''): View
    {
        $this->layout = $layout ?: '';
        return $this;
    }

    /**
     * Get the attributes for the renderer
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Set the attributes for the renderer
     *
     * @param array $attributes
     * @return View
     */
    public function setAttributes(array $attributes = []): View
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * Add an attribute
     *
     * @param string $key
     * @param mixed $value
     * @return View
     */
    public function addAttribute(string $key, $value): View
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Retrieve an attribute
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Get the template path
     *
     * @return string
     */
    public function getTemplatePath(): string
    {
        return $this->templatePath;
    }

    /**
     * Set the template path
     *
     * @param string $templatePath
     * @return View
     */
    public function setTemplatePath(string $templatePath = ''): View
    {
        $this->templatePath = rtrim((string)$templatePath, '/\\') . '/';
        return $this;
    }

    /**
     * Renders a template and returns the result as a string
     *
     * cannot contain template as a key
     *
     * @param string $template
     * @param mixed $data
     *
     * @return string
     *
     * @throws \Throwable
     */
    public function fetch(string $template, $data = []): string
    {
        if (!$template) {
            throw new \RuntimeException("View cannot render unspecified template `$template`.");
        }
        $template = $this->templatePath . $template;
        if (!is_file($template) || !is_readable($template)) {
            throw new \RuntimeException("Cannot render `$template`, the template does not exist or is not readable.");
        }
        $data = array_merge($this->attributes, (array)$data);
        try {
            extract($data, EXTR_SKIP & EXTR_PREFIX_INVALID, 'var');
            ob_start();
            include $template;
            $output = ob_get_clean();
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
        return (string)$output;
    }

}
