{!! '<'.'?xml' !!} version="1.0" encoding="UTF-8"?>
<methodCall>
    <methodName>weblogUpdates.ping</methodName>
    <params>
        <param>
            <value>{{ $title }}</value>
        </param>
        <param>
            <value>{{ $url }}</value>
        </param>
        @if(!empty($rss))
            <param>
                <value>{{ $rss }}</value>
            </param>
        @endif
    </params>
</methodCall>