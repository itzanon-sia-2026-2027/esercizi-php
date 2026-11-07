(function () {
    'use strict';

    var tokens = /("(?:\\[\s\S]|[^"\\])*"|'(?:\\[\s\S]|[^'\\])*'|`(?:\\[\s\S]|[^`\\])*`)|(\/\*[\s\S]*?\*\/|\/\/[^\n]*|#[^\n]*|--[^\n]*)|(<\?(?:php|=)?|\?>|<\/?[a-zA-Z][^<>]*?>)|(\$[a-zA-Z_][\w]*)|\b(abstract|and|as|async|await|break|case|catch|class|const|continue|default|delete|do|echo|else|elseif|empty|endfor|endforeach|endif|exit|extends|false|fetch|finally|for|foreach|function|if|include|include_once|instanceof|let|new|null|or|print|require|require_once|return|static|switch|throw|true|try|unset|use|var|while|add|alter|avg|by|count|create|desc|distinct|drop|from|group|having|inner|insert|into|join|left|like|limit|on|order|select|set|table|update|values|where)\b|\b(\d+(?:\.\d+)?)\b/gi;
    var classes = ['string', 'comment', 'tag', 'variable', 'keyword', 'number'];

    function renderCode(source) {
        var language = source.dataset.language || 'text';
        var text = source.textContent.replace(/<\\\/script/gi, '</script');
        var pre = document.createElement('pre');
        var code = document.createElement('code');
        var lastIndex = 0;
        var match;

        code.className = 'language-' + language;
        if (language === 'text') {
            code.textContent = text;
        } else {
            tokens.lastIndex = 0;
            while ((match = tokens.exec(text)) !== null) {
                code.appendChild(document.createTextNode(text.slice(lastIndex, match.index)));
                var span = document.createElement('span');
                for (var i = 1; i < match.length; i++) {
                    if (match[i] !== undefined) {
                        span.className = 'code-' + classes[i - 1];
                        break;
                    }
                }
                span.textContent = match[0];
                code.appendChild(span);
                lastIndex = tokens.lastIndex;
            }
            code.appendChild(document.createTextNode(text.slice(lastIndex)));
        }
        pre.appendChild(code);
        source.replaceWith(pre);
    }

    document.querySelectorAll('script[type="text/plain"][data-language]').forEach(renderCode);
}());
