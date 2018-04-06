<div class="padding-y-axis:very-large">
    <div class="container">
        <div class="cf margin-bottom:large">
            <div class="tablet--col:2-of-3">
                <span class="heading:large color:blue">{{ $title }}</span>
            </div>
            <div class="tablet--col:1-of-3 tablet--padding-top:medium cf">
                <a class="tablet--float:right" href="{{ $viewAllLinkUrl }}">{{ $viewAllLinkText }}</a>
            </div>
        </div>
        <div class="cf">
            {!! $content !!}
        </div>
    </div>
</div>
