# Laravel AI

{% note %}

**Note:** This package is currently under heavy development and is not yet suitable for production use.

{% endnote %}

The Laravel AI package provides an interface for connecting your Laravel application with AI services, particularly with OpenAI. With this package, you can easily:

- Send requests to OpenAI and receive responses
- Customize the parameters of your requests
- Keep track of all requests and responses in your database
- Keep track of the costs of your requests

## Installation
You can install the package via composer:

```bash 
composer require illegal\laravel-ai
```

After installation, publish the configuration file:

```bash 
php artisan vendor:publish --provider="[Package Name]ServiceProvider"
```

## Configuration

In the .env file, set your OpenAI API key:

```dotenv
AI_OPENAI_API_KEY=YOUR_API_KEY
```

## Command line tools

This package offers a variety of command line tools that simplify interaction with AI services. Each tool prompts you to specify a provider and a model.

The tools include:

### Chat

```shell
php artisan ai:chat
```

This command enables you to initiate a chat with an AI. Once the command is executed, you can begin your conversation.

### Completion

```shell
php artisan ai:complete
```

This command allows you to request the AI to complete your text. Once the command is executed, you can provide your prompt and the AI will generate a response.
