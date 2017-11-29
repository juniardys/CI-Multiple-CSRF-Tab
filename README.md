## CI Multiple CSRF Tab Library

This is CodeIgniter / CI CSRF Multiple Tab library, who allow you to submit the same form in more 1 tab

## Requirements

- `CI Session Library`
1. Can be load on `autoload.php` in `config` folder
2. Can be load with `$this->load->library('session')` before load this library

## How to use

1. Copy file `csrf.php` from `application/libraries` to your CI project
2. Load library with `$this->load->library('csrf')`

## Example

You can downlod, clone, or pull and test in your web server and access in url `{your_site}/demo`. `Demo` file in `controllers` and `view`

## Function

Set this **HTML Attributes** to container id like the **example** 

| Function  | Description | parameter |
| ------------- | ------------- | ------------- |
| `set_name`  | set name of session csrf stored | `$name` name of session  |
| `set_expired`  | set time of csrf expired  | `$expired` time of session expired in second  |
| `refresh_token`  | refresh expired token (delete expired token from session)  | `none`  |
| `gen_token` | generate csrf token | `none` |
| `valid_token` | check token is valid or not | `$value` value of csrf token to checked |
| `delete_token` | remove csrf token from session | `$value` value of csrf token to be deleted |

## Donation

If this plugins help you, you can **Donate to my Paypal account**

**Paypal Account:** juniardysetio@gmail.com