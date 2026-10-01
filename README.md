<p align="center">
  <img src="assets/logo-mark.svg" alt="Laravel AI logo" width="130">
</p>

<h1 align="center">Laravel AI</h1>

<p align="center">
  <em>An early experiment in a fast-moving world.</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/status-archived-FF2D20?style=flat-square" alt="Status: archived">
  <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-FF2D20?style=flat-square" alt="License: MIT"></a>
</p>

<p align="center">
  <strong>Born in 2023 &middot; One interface, many AI providers &middot; Preserved for history</strong>
</p>

<p align="center">
  Back in the &ldquo;distant&rdquo; year of 2023, Laravel AI began with a simple idea: one interface to connect Laravel applications to different AI providers. It never grew beyond an early experiment. Today, <a href="https://github.com/laravel/ai">Laravel's official AI SDK</a> brings that vision to life, and does it beautifully. This repository is now archived, kept as a small piece of that history.
</p>

---

## Historical documentation

The original documentation is preserved below as a record of the project. This package is no longer maintained.

<details>
<summary>Read the original documentation</summary>

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

### Image generate

```shell
php artisan ai:image:generate
```

This command allows you to request the AI to generate an image. Once the command is executed, you can provide your prompt and the AI will generate an image.

</details>
