# Olark Chat Widget
A simple, flexible Olark chat widget integration for Magento.
---

This extension is easy enough for the non-technical to start using,
and advanced enough for developers to customize for their builds.

## How to Install

**Manually extracting from an archive**

**Modman**
```
modman clone https://github.com/vbuck/olark-chat.git
```

**Composer**
```
{
    "require" : {
        "vbuck/olark-chat" : "1.0.0"
    },
    "repositories" : [
        {
            "type" : "vcs",
            "url"  : "https://github.com/vbuck/olark-chat.git"
        }
    ]
}
```

## How to Configure

Once installed, you can toggle its use via `System > Configuration >
Olark Integrations > Chat Widget`.

Then, you need only to enable the extension and add in your Olark ID.

This extension comes with a pre-loaded Olark embed code template, which has 
been pre-configured for custom variables. As the Olark embed code changes
over time, you can easily keep this extension up-to-date yourself.

## Developer Notes

Some things to be aware of:

* The widget block is cached, but its variable processing is not.
* Observe the `olark_chat_render_widget_js` event to customize the widget.
* Custom configuration is conducted through `olark_chat` helper.

## License
The MIT License (MIT)

Copyright (c) 2015 Rick Buczynski

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.