<?php

namespace App;

enum Environment: string
{
    case DEVELOPMENT = 'development';
    case PRODUCTION = 'production';
    case TEST = 'test';
}
