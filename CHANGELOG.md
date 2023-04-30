# Unreleased

# v0.1.3

**Release date**: 2023-04-30

- Added support for db prefix. **IMPORTANT**, if you come from a previous version, your setup is without prefix. 
Either rename all your table with the `ai-` prefix (or whatever you configure via the `.env` file) or setup an empty prefix
in your `.env` file:

```dotenv
AI_DB_PREFIX=
```


# v0.1.2

**Relase date**: 2023-04-02

Base version of the module, with basic functionality and support for Laravel 10