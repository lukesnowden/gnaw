<div class="padding-y-axis:very-large">
    <div class="container">
        <div class="cf margin-bottom:large">
            <div class="tablet--col:8-of-12">
                <span class="heading:large color:blue">{{ $title }}</span>
            </div>
            <div class="tablet--col:4-of-12 tablet--padding-top:medium cf">
                <a class="tablet--float:right" href="{{ $viewAllLinkUrl }}">{{ $viewAllLinkText }}</a>
            </div>
        </div>
        <div class="cf">
            {!! $content !!}
        </div>
    </div>
</div>
