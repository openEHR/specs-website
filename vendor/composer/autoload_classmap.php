<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'App\\Action\\ComponentsAction' => $baseDir . '/src/Action/ComponentsAction.php',
    'App\\Action\\DevelopmentBaselineAction' => $baseDir . '/src/Action/DevelopmentBaselineAction.php',
    'App\\Action\\FHIRViewerAction' => $baseDir . '/src/Action/FHIRViewerAction.php',
    'App\\Action\\HistoricalReleasesAction' => $baseDir . '/src/Action/HistoricalReleasesAction.php',
    'App\\Action\\HookAction' => $baseDir . '/src/Action/HookAction.php',
    'App\\Action\\ITSAction' => $baseDir . '/src/Action/ITSAction.php',
    'App\\Action\\RedirectAction' => $baseDir . '/src/Action/RedirectAction.php',
    'App\\Action\\ReleaseBaselineAction' => $baseDir . '/src/Action/ReleaseBaselineAction.php',
    'App\\Action\\ReleasesAction' => $baseDir . '/src/Action/ReleasesAction.php',
    'App\\Action\\SearchAction' => $baseDir . '/src/Action/SearchAction.php',
    'App\\Action\\SpecViewerAction' => $baseDir . '/src/Action/SpecViewerAction.php',
    'App\\Action\\StartAction' => $baseDir . '/src/Action/StartAction.php',
    'App\\Action\\UMLViewerAction' => $baseDir . '/src/Action/UMLViewerAction.php',
    'App\\Configuration' => $baseDir . '/src/Configuration.php',
    'App\\Domain\\Data\\AbstractModel' => $baseDir . '/src/Domain/Data/AbstractModel.php',
    'App\\Domain\\Data\\Component' => $baseDir . '/src/Domain/Data/Component.php',
    'App\\Domain\\Data\\Dependency' => $baseDir . '/src/Domain/Data/Dependency.php',
    'App\\Domain\\Data\\Expression' => $baseDir . '/src/Domain/Data/Expression.php',
    'App\\Domain\\Data\\Jira' => $baseDir . '/src/Domain/Data/Jira.php',
    'App\\Domain\\Data\\Note' => $baseDir . '/src/Domain/Data/Note.php',
    'App\\Domain\\Data\\Package' => $baseDir . '/src/Domain/Data/Package.php',
    'App\\Domain\\Data\\Release' => $baseDir . '/src/Domain/Data/Release.php',
    'App\\Domain\\Data\\Specification' => $baseDir . '/src/Domain/Data/Specification.php',
    'App\\Domain\\Data\\Type' => $baseDir . '/src/Domain/Data/Type.php',
    'App\\Domain\\Service\\ComponentService' => $baseDir . '/src/Domain/Service/ComponentService.php',
    'App\\Domain\\Service\\SearchService' => $baseDir . '/src/Domain/Service/SearchService.php',
    'App\\Domain\\Service\\TypeService' => $baseDir . '/src/Domain/Service/TypeService.php',
    'App\\Helper\\File' => $baseDir . '/src/Helper/File.php',
    'App\\Helper\\ITSAsset' => $baseDir . '/src/Helper/ITSAsset.php',
    'App\\View' => $baseDir . '/src/View.php',
    'App\\View\\NavBar' => $baseDir . '/src/View/NavBar.php',
    'App\\View\\NavItem' => $baseDir . '/src/View/NavItem.php',
    'App\\View\\Page' => $baseDir . '/src/View/Page.php',
    'Attribute' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'DI\\Annotation\\Inject' => $vendorDir . '/php-di/php-di/src/Annotation/Inject.php',
    'DI\\Annotation\\Injectable' => $vendorDir . '/php-di/php-di/src/Annotation/Injectable.php',
    'DI\\CompiledContainer' => $vendorDir . '/php-di/php-di/src/CompiledContainer.php',
    'DI\\Compiler\\Compiler' => $vendorDir . '/php-di/php-di/src/Compiler/Compiler.php',
    'DI\\Compiler\\ObjectCreationCompiler' => $vendorDir . '/php-di/php-di/src/Compiler/ObjectCreationCompiler.php',
    'DI\\Compiler\\RequestedEntryHolder' => $vendorDir . '/php-di/php-di/src/Compiler/RequestedEntryHolder.php',
    'DI\\Container' => $vendorDir . '/php-di/php-di/src/Container.php',
    'DI\\ContainerBuilder' => $vendorDir . '/php-di/php-di/src/ContainerBuilder.php',
    'DI\\Definition\\ArrayDefinition' => $vendorDir . '/php-di/php-di/src/Definition/ArrayDefinition.php',
    'DI\\Definition\\ArrayDefinitionExtension' => $vendorDir . '/php-di/php-di/src/Definition/ArrayDefinitionExtension.php',
    'DI\\Definition\\AutowireDefinition' => $vendorDir . '/php-di/php-di/src/Definition/AutowireDefinition.php',
    'DI\\Definition\\DecoratorDefinition' => $vendorDir . '/php-di/php-di/src/Definition/DecoratorDefinition.php',
    'DI\\Definition\\Definition' => $vendorDir . '/php-di/php-di/src/Definition/Definition.php',
    'DI\\Definition\\Dumper\\ObjectDefinitionDumper' => $vendorDir . '/php-di/php-di/src/Definition/Dumper/ObjectDefinitionDumper.php',
    'DI\\Definition\\EnvironmentVariableDefinition' => $vendorDir . '/php-di/php-di/src/Definition/EnvironmentVariableDefinition.php',
    'DI\\Definition\\Exception\\InvalidAnnotation' => $vendorDir . '/php-di/php-di/src/Definition/Exception/InvalidAnnotation.php',
    'DI\\Definition\\Exception\\InvalidDefinition' => $vendorDir . '/php-di/php-di/src/Definition/Exception/InvalidDefinition.php',
    'DI\\Definition\\ExtendsPreviousDefinition' => $vendorDir . '/php-di/php-di/src/Definition/ExtendsPreviousDefinition.php',
    'DI\\Definition\\FactoryDefinition' => $vendorDir . '/php-di/php-di/src/Definition/FactoryDefinition.php',
    'DI\\Definition\\Helper\\AutowireDefinitionHelper' => $vendorDir . '/php-di/php-di/src/Definition/Helper/AutowireDefinitionHelper.php',
    'DI\\Definition\\Helper\\CreateDefinitionHelper' => $vendorDir . '/php-di/php-di/src/Definition/Helper/CreateDefinitionHelper.php',
    'DI\\Definition\\Helper\\DefinitionHelper' => $vendorDir . '/php-di/php-di/src/Definition/Helper/DefinitionHelper.php',
    'DI\\Definition\\Helper\\FactoryDefinitionHelper' => $vendorDir . '/php-di/php-di/src/Definition/Helper/FactoryDefinitionHelper.php',
    'DI\\Definition\\InstanceDefinition' => $vendorDir . '/php-di/php-di/src/Definition/InstanceDefinition.php',
    'DI\\Definition\\ObjectDefinition' => $vendorDir . '/php-di/php-di/src/Definition/ObjectDefinition.php',
    'DI\\Definition\\ObjectDefinition\\MethodInjection' => $vendorDir . '/php-di/php-di/src/Definition/ObjectDefinition/MethodInjection.php',
    'DI\\Definition\\ObjectDefinition\\PropertyInjection' => $vendorDir . '/php-di/php-di/src/Definition/ObjectDefinition/PropertyInjection.php',
    'DI\\Definition\\Reference' => $vendorDir . '/php-di/php-di/src/Definition/Reference.php',
    'DI\\Definition\\Resolver\\ArrayResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/ArrayResolver.php',
    'DI\\Definition\\Resolver\\DecoratorResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/DecoratorResolver.php',
    'DI\\Definition\\Resolver\\DefinitionResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/DefinitionResolver.php',
    'DI\\Definition\\Resolver\\EnvironmentVariableResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/EnvironmentVariableResolver.php',
    'DI\\Definition\\Resolver\\FactoryResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/FactoryResolver.php',
    'DI\\Definition\\Resolver\\InstanceInjector' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/InstanceInjector.php',
    'DI\\Definition\\Resolver\\ObjectCreator' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/ObjectCreator.php',
    'DI\\Definition\\Resolver\\ParameterResolver' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/ParameterResolver.php',
    'DI\\Definition\\Resolver\\ResolverDispatcher' => $vendorDir . '/php-di/php-di/src/Definition/Resolver/ResolverDispatcher.php',
    'DI\\Definition\\SelfResolvingDefinition' => $vendorDir . '/php-di/php-di/src/Definition/SelfResolvingDefinition.php',
    'DI\\Definition\\Source\\AnnotationBasedAutowiring' => $vendorDir . '/php-di/php-di/src/Definition/Source/AnnotationBasedAutowiring.php',
    'DI\\Definition\\Source\\Autowiring' => $vendorDir . '/php-di/php-di/src/Definition/Source/Autowiring.php',
    'DI\\Definition\\Source\\DefinitionArray' => $vendorDir . '/php-di/php-di/src/Definition/Source/DefinitionArray.php',
    'DI\\Definition\\Source\\DefinitionFile' => $vendorDir . '/php-di/php-di/src/Definition/Source/DefinitionFile.php',
    'DI\\Definition\\Source\\DefinitionNormalizer' => $vendorDir . '/php-di/php-di/src/Definition/Source/DefinitionNormalizer.php',
    'DI\\Definition\\Source\\DefinitionSource' => $vendorDir . '/php-di/php-di/src/Definition/Source/DefinitionSource.php',
    'DI\\Definition\\Source\\MutableDefinitionSource' => $vendorDir . '/php-di/php-di/src/Definition/Source/MutableDefinitionSource.php',
    'DI\\Definition\\Source\\NoAutowiring' => $vendorDir . '/php-di/php-di/src/Definition/Source/NoAutowiring.php',
    'DI\\Definition\\Source\\ReflectionBasedAutowiring' => $vendorDir . '/php-di/php-di/src/Definition/Source/ReflectionBasedAutowiring.php',
    'DI\\Definition\\Source\\SourceCache' => $vendorDir . '/php-di/php-di/src/Definition/Source/SourceCache.php',
    'DI\\Definition\\Source\\SourceChain' => $vendorDir . '/php-di/php-di/src/Definition/Source/SourceChain.php',
    'DI\\Definition\\StringDefinition' => $vendorDir . '/php-di/php-di/src/Definition/StringDefinition.php',
    'DI\\Definition\\ValueDefinition' => $vendorDir . '/php-di/php-di/src/Definition/ValueDefinition.php',
    'DI\\DependencyException' => $vendorDir . '/php-di/php-di/src/DependencyException.php',
    'DI\\FactoryInterface' => $vendorDir . '/php-di/php-di/src/FactoryInterface.php',
    'DI\\Factory\\RequestedEntry' => $vendorDir . '/php-di/php-di/src/Factory/RequestedEntry.php',
    'DI\\Invoker\\DefinitionParameterResolver' => $vendorDir . '/php-di/php-di/src/Invoker/DefinitionParameterResolver.php',
    'DI\\Invoker\\FactoryParameterResolver' => $vendorDir . '/php-di/php-di/src/Invoker/FactoryParameterResolver.php',
    'DI\\NotFoundException' => $vendorDir . '/php-di/php-di/src/NotFoundException.php',
    'DI\\Proxy\\ProxyFactory' => $vendorDir . '/php-di/php-di/src/Proxy/ProxyFactory.php',
    'FastRoute\\BadRouteException' => $vendorDir . '/nikic/fast-route/src/BadRouteException.php',
    'FastRoute\\DataGenerator' => $vendorDir . '/nikic/fast-route/src/DataGenerator.php',
    'FastRoute\\DataGenerator\\CharCountBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/CharCountBased.php',
    'FastRoute\\DataGenerator\\GroupCountBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/GroupCountBased.php',
    'FastRoute\\DataGenerator\\GroupPosBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/GroupPosBased.php',
    'FastRoute\\DataGenerator\\MarkBased' => $vendorDir . '/nikic/fast-route/src/DataGenerator/MarkBased.php',
    'FastRoute\\DataGenerator\\RegexBasedAbstract' => $vendorDir . '/nikic/fast-route/src/DataGenerator/RegexBasedAbstract.php',
    'FastRoute\\Dispatcher' => $vendorDir . '/nikic/fast-route/src/Dispatcher.php',
    'FastRoute\\Dispatcher\\CharCountBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/CharCountBased.php',
    'FastRoute\\Dispatcher\\GroupCountBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/GroupCountBased.php',
    'FastRoute\\Dispatcher\\GroupPosBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/GroupPosBased.php',
    'FastRoute\\Dispatcher\\MarkBased' => $vendorDir . '/nikic/fast-route/src/Dispatcher/MarkBased.php',
    'FastRoute\\Dispatcher\\RegexBasedAbstract' => $vendorDir . '/nikic/fast-route/src/Dispatcher/RegexBasedAbstract.php',
    'FastRoute\\Route' => $vendorDir . '/nikic/fast-route/src/Route.php',
    'FastRoute\\RouteCollector' => $vendorDir . '/nikic/fast-route/src/RouteCollector.php',
    'FastRoute\\RouteParser' => $vendorDir . '/nikic/fast-route/src/RouteParser.php',
    'FastRoute\\RouteParser\\Std' => $vendorDir . '/nikic/fast-route/src/RouteParser/Std.php',
    'Fig\\Http\\Message\\RequestMethodInterface' => $vendorDir . '/fig/http-message-util/src/RequestMethodInterface.php',
    'Fig\\Http\\Message\\StatusCodeInterface' => $vendorDir . '/fig/http-message-util/src/StatusCodeInterface.php',
    'Invoker\\CallableResolver' => $vendorDir . '/php-di/invoker/src/CallableResolver.php',
    'Invoker\\Exception\\InvocationException' => $vendorDir . '/php-di/invoker/src/Exception/InvocationException.php',
    'Invoker\\Exception\\NotCallableException' => $vendorDir . '/php-di/invoker/src/Exception/NotCallableException.php',
    'Invoker\\Exception\\NotEnoughParametersException' => $vendorDir . '/php-di/invoker/src/Exception/NotEnoughParametersException.php',
    'Invoker\\Invoker' => $vendorDir . '/php-di/invoker/src/Invoker.php',
    'Invoker\\InvokerInterface' => $vendorDir . '/php-di/invoker/src/InvokerInterface.php',
    'Invoker\\ParameterResolver\\AssociativeArrayResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/AssociativeArrayResolver.php',
    'Invoker\\ParameterResolver\\Container\\ParameterNameContainerResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/Container/ParameterNameContainerResolver.php',
    'Invoker\\ParameterResolver\\Container\\TypeHintContainerResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/Container/TypeHintContainerResolver.php',
    'Invoker\\ParameterResolver\\DefaultValueResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/DefaultValueResolver.php',
    'Invoker\\ParameterResolver\\NumericArrayResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/NumericArrayResolver.php',
    'Invoker\\ParameterResolver\\ParameterResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/ParameterResolver.php',
    'Invoker\\ParameterResolver\\ResolverChain' => $vendorDir . '/php-di/invoker/src/ParameterResolver/ResolverChain.php',
    'Invoker\\ParameterResolver\\TypeHintResolver' => $vendorDir . '/php-di/invoker/src/ParameterResolver/TypeHintResolver.php',
    'Invoker\\Reflection\\CallableReflection' => $vendorDir . '/php-di/invoker/src/Reflection/CallableReflection.php',
    'Laravel\\SerializableClosure\\Contracts\\Serializable' => $vendorDir . '/laravel/serializable-closure/src/Contracts/Serializable.php',
    'Laravel\\SerializableClosure\\Contracts\\Signer' => $vendorDir . '/laravel/serializable-closure/src/Contracts/Signer.php',
    'Laravel\\SerializableClosure\\Exceptions\\InvalidSignatureException' => $vendorDir . '/laravel/serializable-closure/src/Exceptions/InvalidSignatureException.php',
    'Laravel\\SerializableClosure\\Exceptions\\MissingSecretKeyException' => $vendorDir . '/laravel/serializable-closure/src/Exceptions/MissingSecretKeyException.php',
    'Laravel\\SerializableClosure\\Exceptions\\PhpVersionNotSupportedException' => $vendorDir . '/laravel/serializable-closure/src/Exceptions/PhpVersionNotSupportedException.php',
    'Laravel\\SerializableClosure\\SerializableClosure' => $vendorDir . '/laravel/serializable-closure/src/SerializableClosure.php',
    'Laravel\\SerializableClosure\\Serializers\\Native' => $vendorDir . '/laravel/serializable-closure/src/Serializers/Native.php',
    'Laravel\\SerializableClosure\\Serializers\\Signed' => $vendorDir . '/laravel/serializable-closure/src/Serializers/Signed.php',
    'Laravel\\SerializableClosure\\Signers\\Hmac' => $vendorDir . '/laravel/serializable-closure/src/Signers/Hmac.php',
    'Laravel\\SerializableClosure\\Support\\ClosureScope' => $vendorDir . '/laravel/serializable-closure/src/Support/ClosureScope.php',
    'Laravel\\SerializableClosure\\Support\\ClosureStream' => $vendorDir . '/laravel/serializable-closure/src/Support/ClosureStream.php',
    'Laravel\\SerializableClosure\\Support\\ReflectionClosure' => $vendorDir . '/laravel/serializable-closure/src/Support/ReflectionClosure.php',
    'Laravel\\SerializableClosure\\Support\\SelfReference' => $vendorDir . '/laravel/serializable-closure/src/Support/SelfReference.php',
    'Laravel\\SerializableClosure\\UnsignedSerializableClosure' => $vendorDir . '/laravel/serializable-closure/src/UnsignedSerializableClosure.php',
    'PhpDocReader\\AnnotationException' => $vendorDir . '/php-di/phpdoc-reader/src/PhpDocReader/AnnotationException.php',
    'PhpDocReader\\PhpDocReader' => $vendorDir . '/php-di/phpdoc-reader/src/PhpDocReader/PhpDocReader.php',
    'PhpDocReader\\PhpParser\\TokenParser' => $vendorDir . '/php-di/phpdoc-reader/src/PhpDocReader/PhpParser/TokenParser.php',
    'PhpDocReader\\PhpParser\\UseStatementParser' => $vendorDir . '/php-di/phpdoc-reader/src/PhpDocReader/PhpParser/UseStatementParser.php',
    'PhpToken' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
    'Psr\\Container\\ContainerExceptionInterface' => $vendorDir . '/psr/container/src/ContainerExceptionInterface.php',
    'Psr\\Container\\ContainerInterface' => $vendorDir . '/psr/container/src/ContainerInterface.php',
    'Psr\\Container\\NotFoundExceptionInterface' => $vendorDir . '/psr/container/src/NotFoundExceptionInterface.php',
    'Psr\\Http\\Message\\MessageInterface' => $vendorDir . '/psr/http-message/src/MessageInterface.php',
    'Psr\\Http\\Message\\RequestFactoryInterface' => $vendorDir . '/psr/http-factory/src/RequestFactoryInterface.php',
    'Psr\\Http\\Message\\RequestInterface' => $vendorDir . '/psr/http-message/src/RequestInterface.php',
    'Psr\\Http\\Message\\ResponseFactoryInterface' => $vendorDir . '/psr/http-factory/src/ResponseFactoryInterface.php',
    'Psr\\Http\\Message\\ResponseInterface' => $vendorDir . '/psr/http-message/src/ResponseInterface.php',
    'Psr\\Http\\Message\\ServerRequestFactoryInterface' => $vendorDir . '/psr/http-factory/src/ServerRequestFactoryInterface.php',
    'Psr\\Http\\Message\\ServerRequestInterface' => $vendorDir . '/psr/http-message/src/ServerRequestInterface.php',
    'Psr\\Http\\Message\\StreamFactoryInterface' => $vendorDir . '/psr/http-factory/src/StreamFactoryInterface.php',
    'Psr\\Http\\Message\\StreamInterface' => $vendorDir . '/psr/http-message/src/StreamInterface.php',
    'Psr\\Http\\Message\\UploadedFileFactoryInterface' => $vendorDir . '/psr/http-factory/src/UploadedFileFactoryInterface.php',
    'Psr\\Http\\Message\\UploadedFileInterface' => $vendorDir . '/psr/http-message/src/UploadedFileInterface.php',
    'Psr\\Http\\Message\\UriFactoryInterface' => $vendorDir . '/psr/http-factory/src/UriFactoryInterface.php',
    'Psr\\Http\\Message\\UriInterface' => $vendorDir . '/psr/http-message/src/UriInterface.php',
    'Psr\\Http\\Server\\MiddlewareInterface' => $vendorDir . '/psr/http-server-middleware/src/MiddlewareInterface.php',
    'Psr\\Http\\Server\\RequestHandlerInterface' => $vendorDir . '/psr/http-server-handler/src/RequestHandlerInterface.php',
    'Psr\\Log\\AbstractLogger' => $vendorDir . '/psr/log/src/AbstractLogger.php',
    'Psr\\Log\\InvalidArgumentException' => $vendorDir . '/psr/log/src/InvalidArgumentException.php',
    'Psr\\Log\\LogLevel' => $vendorDir . '/psr/log/src/LogLevel.php',
    'Psr\\Log\\LoggerAwareInterface' => $vendorDir . '/psr/log/src/LoggerAwareInterface.php',
    'Psr\\Log\\LoggerAwareTrait' => $vendorDir . '/psr/log/src/LoggerAwareTrait.php',
    'Psr\\Log\\LoggerInterface' => $vendorDir . '/psr/log/src/LoggerInterface.php',
    'Psr\\Log\\LoggerTrait' => $vendorDir . '/psr/log/src/LoggerTrait.php',
    'Psr\\Log\\NullLogger' => $vendorDir . '/psr/log/src/NullLogger.php',
    'Slim\\App' => $vendorDir . '/slim/slim/Slim/App.php',
    'Slim\\CallableResolver' => $vendorDir . '/slim/slim/Slim/CallableResolver.php',
    'Slim\\Error\\AbstractErrorRenderer' => $vendorDir . '/slim/slim/Slim/Error/AbstractErrorRenderer.php',
    'Slim\\Error\\Renderers\\HtmlErrorRenderer' => $vendorDir . '/slim/slim/Slim/Error/Renderers/HtmlErrorRenderer.php',
    'Slim\\Error\\Renderers\\JsonErrorRenderer' => $vendorDir . '/slim/slim/Slim/Error/Renderers/JsonErrorRenderer.php',
    'Slim\\Error\\Renderers\\PlainTextErrorRenderer' => $vendorDir . '/slim/slim/Slim/Error/Renderers/PlainTextErrorRenderer.php',
    'Slim\\Error\\Renderers\\XmlErrorRenderer' => $vendorDir . '/slim/slim/Slim/Error/Renderers/XmlErrorRenderer.php',
    'Slim\\Exception\\HttpBadRequestException' => $vendorDir . '/slim/slim/Slim/Exception/HttpBadRequestException.php',
    'Slim\\Exception\\HttpException' => $vendorDir . '/slim/slim/Slim/Exception/HttpException.php',
    'Slim\\Exception\\HttpForbiddenException' => $vendorDir . '/slim/slim/Slim/Exception/HttpForbiddenException.php',
    'Slim\\Exception\\HttpGoneException' => $vendorDir . '/slim/slim/Slim/Exception/HttpGoneException.php',
    'Slim\\Exception\\HttpInternalServerErrorException' => $vendorDir . '/slim/slim/Slim/Exception/HttpInternalServerErrorException.php',
    'Slim\\Exception\\HttpMethodNotAllowedException' => $vendorDir . '/slim/slim/Slim/Exception/HttpMethodNotAllowedException.php',
    'Slim\\Exception\\HttpNotFoundException' => $vendorDir . '/slim/slim/Slim/Exception/HttpNotFoundException.php',
    'Slim\\Exception\\HttpNotImplementedException' => $vendorDir . '/slim/slim/Slim/Exception/HttpNotImplementedException.php',
    'Slim\\Exception\\HttpSpecializedException' => $vendorDir . '/slim/slim/Slim/Exception/HttpSpecializedException.php',
    'Slim\\Exception\\HttpUnauthorizedException' => $vendorDir . '/slim/slim/Slim/Exception/HttpUnauthorizedException.php',
    'Slim\\Factory\\AppFactory' => $vendorDir . '/slim/slim/Slim/Factory/AppFactory.php',
    'Slim\\Factory\\Psr17\\GuzzlePsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/GuzzlePsr17Factory.php',
    'Slim\\Factory\\Psr17\\HttpSoftPsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/HttpSoftPsr17Factory.php',
    'Slim\\Factory\\Psr17\\LaminasDiactorosPsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/LaminasDiactorosPsr17Factory.php',
    'Slim\\Factory\\Psr17\\NyholmPsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/NyholmPsr17Factory.php',
    'Slim\\Factory\\Psr17\\Psr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/Psr17Factory.php',
    'Slim\\Factory\\Psr17\\Psr17FactoryProvider' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/Psr17FactoryProvider.php',
    'Slim\\Factory\\Psr17\\ServerRequestCreator' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/ServerRequestCreator.php',
    'Slim\\Factory\\Psr17\\SlimHttpPsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/SlimHttpPsr17Factory.php',
    'Slim\\Factory\\Psr17\\SlimHttpServerRequestCreator' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/SlimHttpServerRequestCreator.php',
    'Slim\\Factory\\Psr17\\SlimPsr17Factory' => $vendorDir . '/slim/slim/Slim/Factory/Psr17/SlimPsr17Factory.php',
    'Slim\\Factory\\ServerRequestCreatorFactory' => $vendorDir . '/slim/slim/Slim/Factory/ServerRequestCreatorFactory.php',
    'Slim\\Handlers\\ErrorHandler' => $vendorDir . '/slim/slim/Slim/Handlers/ErrorHandler.php',
    'Slim\\Handlers\\Strategies\\RequestHandler' => $vendorDir . '/slim/slim/Slim/Handlers/Strategies/RequestHandler.php',
    'Slim\\Handlers\\Strategies\\RequestResponse' => $vendorDir . '/slim/slim/Slim/Handlers/Strategies/RequestResponse.php',
    'Slim\\Handlers\\Strategies\\RequestResponseArgs' => $vendorDir . '/slim/slim/Slim/Handlers/Strategies/RequestResponseArgs.php',
    'Slim\\Handlers\\Strategies\\RequestResponseNamedArgs' => $vendorDir . '/slim/slim/Slim/Handlers/Strategies/RequestResponseNamedArgs.php',
    'Slim\\Http\\Factory\\DecoratedResponseFactory' => $vendorDir . '/slim/http/src/Factory/DecoratedResponseFactory.php',
    'Slim\\Http\\Factory\\DecoratedServerRequestFactory' => $vendorDir . '/slim/http/src/Factory/DecoratedServerRequestFactory.php',
    'Slim\\Http\\Factory\\DecoratedUriFactory' => $vendorDir . '/slim/http/src/Factory/DecoratedUriFactory.php',
    'Slim\\Http\\Interfaces\\ResponseInterface' => $vendorDir . '/slim/http/src/Interfaces/ResponseInterface.php',
    'Slim\\Http\\Response' => $vendorDir . '/slim/http/src/Response.php',
    'Slim\\Http\\ServerRequest' => $vendorDir . '/slim/http/src/ServerRequest.php',
    'Slim\\Http\\Uri' => $vendorDir . '/slim/http/src/Uri.php',
    'Slim\\Interfaces\\AdvancedCallableResolverInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/AdvancedCallableResolverInterface.php',
    'Slim\\Interfaces\\CallableResolverInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/CallableResolverInterface.php',
    'Slim\\Interfaces\\DispatcherInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/DispatcherInterface.php',
    'Slim\\Interfaces\\ErrorHandlerInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/ErrorHandlerInterface.php',
    'Slim\\Interfaces\\ErrorRendererInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/ErrorRendererInterface.php',
    'Slim\\Interfaces\\InvocationStrategyInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/InvocationStrategyInterface.php',
    'Slim\\Interfaces\\MiddlewareDispatcherInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/MiddlewareDispatcherInterface.php',
    'Slim\\Interfaces\\Psr17FactoryInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/Psr17FactoryInterface.php',
    'Slim\\Interfaces\\Psr17FactoryProviderInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/Psr17FactoryProviderInterface.php',
    'Slim\\Interfaces\\RequestHandlerInvocationStrategyInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RequestHandlerInvocationStrategyInterface.php',
    'Slim\\Interfaces\\RouteCollectorInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteCollectorInterface.php',
    'Slim\\Interfaces\\RouteCollectorProxyInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteCollectorProxyInterface.php',
    'Slim\\Interfaces\\RouteGroupInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteGroupInterface.php',
    'Slim\\Interfaces\\RouteInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteInterface.php',
    'Slim\\Interfaces\\RouteParserInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteParserInterface.php',
    'Slim\\Interfaces\\RouteResolverInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/RouteResolverInterface.php',
    'Slim\\Interfaces\\ServerRequestCreatorInterface' => $vendorDir . '/slim/slim/Slim/Interfaces/ServerRequestCreatorInterface.php',
    'Slim\\Logger' => $vendorDir . '/slim/slim/Slim/Logger.php',
    'Slim\\MiddlewareDispatcher' => $vendorDir . '/slim/slim/Slim/MiddlewareDispatcher.php',
    'Slim\\Middleware\\BodyParsingMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/BodyParsingMiddleware.php',
    'Slim\\Middleware\\ContentLengthMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/ContentLengthMiddleware.php',
    'Slim\\Middleware\\ErrorMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/ErrorMiddleware.php',
    'Slim\\Middleware\\MethodOverrideMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/MethodOverrideMiddleware.php',
    'Slim\\Middleware\\OutputBufferingMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/OutputBufferingMiddleware.php',
    'Slim\\Middleware\\RoutingMiddleware' => $vendorDir . '/slim/slim/Slim/Middleware/RoutingMiddleware.php',
    'Slim\\Psr7\\Cookies' => $vendorDir . '/slim/psr7/src/Cookies.php',
    'Slim\\Psr7\\Environment' => $vendorDir . '/slim/psr7/src/Environment.php',
    'Slim\\Psr7\\Factory\\RequestFactory' => $vendorDir . '/slim/psr7/src/Factory/RequestFactory.php',
    'Slim\\Psr7\\Factory\\ResponseFactory' => $vendorDir . '/slim/psr7/src/Factory/ResponseFactory.php',
    'Slim\\Psr7\\Factory\\ServerRequestFactory' => $vendorDir . '/slim/psr7/src/Factory/ServerRequestFactory.php',
    'Slim\\Psr7\\Factory\\StreamFactory' => $vendorDir . '/slim/psr7/src/Factory/StreamFactory.php',
    'Slim\\Psr7\\Factory\\UploadedFileFactory' => $vendorDir . '/slim/psr7/src/Factory/UploadedFileFactory.php',
    'Slim\\Psr7\\Factory\\UriFactory' => $vendorDir . '/slim/psr7/src/Factory/UriFactory.php',
    'Slim\\Psr7\\Header' => $vendorDir . '/slim/psr7/src/Header.php',
    'Slim\\Psr7\\Headers' => $vendorDir . '/slim/psr7/src/Headers.php',
    'Slim\\Psr7\\Interfaces\\HeadersInterface' => $vendorDir . '/slim/psr7/src/Interfaces/HeadersInterface.php',
    'Slim\\Psr7\\Message' => $vendorDir . '/slim/psr7/src/Message.php',
    'Slim\\Psr7\\NonBufferedBody' => $vendorDir . '/slim/psr7/src/NonBufferedBody.php',
    'Slim\\Psr7\\Request' => $vendorDir . '/slim/psr7/src/Request.php',
    'Slim\\Psr7\\Response' => $vendorDir . '/slim/psr7/src/Response.php',
    'Slim\\Psr7\\Stream' => $vendorDir . '/slim/psr7/src/Stream.php',
    'Slim\\Psr7\\UploadedFile' => $vendorDir . '/slim/psr7/src/UploadedFile.php',
    'Slim\\Psr7\\Uri' => $vendorDir . '/slim/psr7/src/Uri.php',
    'Slim\\ResponseEmitter' => $vendorDir . '/slim/slim/Slim/ResponseEmitter.php',
    'Slim\\Routing\\Dispatcher' => $vendorDir . '/slim/slim/Slim/Routing/Dispatcher.php',
    'Slim\\Routing\\FastRouteDispatcher' => $vendorDir . '/slim/slim/Slim/Routing/FastRouteDispatcher.php',
    'Slim\\Routing\\Route' => $vendorDir . '/slim/slim/Slim/Routing/Route.php',
    'Slim\\Routing\\RouteCollector' => $vendorDir . '/slim/slim/Slim/Routing/RouteCollector.php',
    'Slim\\Routing\\RouteCollectorProxy' => $vendorDir . '/slim/slim/Slim/Routing/RouteCollectorProxy.php',
    'Slim\\Routing\\RouteContext' => $vendorDir . '/slim/slim/Slim/Routing/RouteContext.php',
    'Slim\\Routing\\RouteGroup' => $vendorDir . '/slim/slim/Slim/Routing/RouteGroup.php',
    'Slim\\Routing\\RouteParser' => $vendorDir . '/slim/slim/Slim/Routing/RouteParser.php',
    'Slim\\Routing\\RouteResolver' => $vendorDir . '/slim/slim/Slim/Routing/RouteResolver.php',
    'Slim\\Routing\\RouteRunner' => $vendorDir . '/slim/slim/Slim/Routing/RouteRunner.php',
    'Slim\\Routing\\RoutingResults' => $vendorDir . '/slim/slim/Slim/Routing/RoutingResults.php',
    'Stringable' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
    'Symfony\\Polyfill\\Php80\\Php80' => $vendorDir . '/symfony/polyfill-php80/Php80.php',
    'Symfony\\Polyfill\\Php80\\PhpToken' => $vendorDir . '/symfony/polyfill-php80/PhpToken.php',
    'UnhandledMatchError' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
    'ValueError' => $vendorDir . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
);
