<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $title }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach($breadcums as $breadcum)                    
                        <li class="breadcrumb-item">{{ $breadcum }} </li>
                    @endforeach
                </ol>
                <div style="border-top :1px solid var(--bs-gray); text-align:right; margin-top : 5px; padding:5px;">
                    @foreach($links as $link)
                        @php
                           $cssClass = isset($link['class']) ? $link['class'] : 'btn btn-soft-primary waves-effect waves-light btn-sm';
                        @endphp
                        <a class="{{ $cssClass }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>