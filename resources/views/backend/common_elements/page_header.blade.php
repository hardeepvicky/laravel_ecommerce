<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $page_title }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach($breadcums as $breadcum)                    
                        <li class="breadcrumb-item">
                            {{ $breadcum['title'] }}
                        </li>
                    @endforeach
                </ol>
                <div style="border-top :1px solid var(--bs-gray); text-align:right; margin-top : 5px; padding:5px;">
                    @if (isset($page_header_links))                    
                        @foreach($page_header_links as $link)
                            @php
                                $cssClass = isset($link['class']) ? $link['class'] : 'btn btn-soft-primary waves-effect waves-light btn-sm';
                            @endphp
                            <a class="{{ $cssClass }}" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
                        @endforeach 
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>