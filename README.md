# Notification handler for Kohana framework

This is a notification handler. It is similar to a logger, but designed for
users.

    Notification::instance()->add(Notification::SUCCESS, "You have succeed!.");

There is also an validation error handler.

    Notification::instance()->errors($validation_exception);

## Usage

Add the view "notifications" anywhere in your code. Add the view "errors" at the
bottom of your template. The latest has js code to bind errors with field in a
Bootstrap way.