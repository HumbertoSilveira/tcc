<div class="box box-{{ $type }}{{ isset($box_class) ? ' '.$box_class : '' }}">
    @if (isset($title))
        <div class="box-header with-border{{ isset($box_header_class) ? ' '.$box_header_class : '' }}">
            <h3 class="box-title">
                @if (isset($icon))<i class="fa fa-fw fa-{{ $icon }}"></i> @endif
                {{ $title }}
            </h3>

            @if(isset($actions))
                <div class="box-tools">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="box-body{{ isset($body_class) ? ' '.$body_class : '' }}">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="box-footer">
            {{ $footer }}
        </div>
    @endif
</div>
