<style>
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 3;
        color: #394247;
        cursor: default;
        background-color: #fff;
        border-color: rgb(230, 230, 230);
    }

</style>

@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}

        @php
            $curr=$paginator->currentPage();
                          $my_pages=array();
                                 foreach ($elements as $k=>$v){
                                     if(is_array($v)){
                                             foreach ($v as $ks=>$vs){
                                             $my_pages[$ks]=$vs;
                                             }
                                     }
                                 }
                          end($my_pages);
                          $lsat = key($my_pages);

        @endphp


        @if ($paginator->onFirstPage())

            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            @if($paginator->currentPage() > 2)
                <li class='page-item'><a class='page-link' href='{{$my_pages[1]}}'>&lsaquo;&lsaquo;</a></li>

            @endif
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
       {{-- @foreach ($elements as $element)
            --}}{{-- "Three Dots" Separator --}}{{--
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            --}}{{-- Array Of Links --}}{{--
            @if (is_array($element))

                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach--}}

{{--
        @foreach ($elements as $key => $element)
            --}}{{-- "Three Dots" Separator --}}{{--
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            --}}{{-- Array Of Links --}}{{--
            @if (is_array($element))

                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else


                           --}}{{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}{{--

                        @if($key===0)
                                @if(count($element)==2 && count($elements)>1)
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @break;
                                @elseif(count($element)>2 && count($elements)>1)
                                        @if($page>4)
                                               @continue;
                                          @else
                                              <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                          @endif
                                    @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>



                                @endif
                        @elseif($key===4)
                            @if(count($element)==2 && count($elements)>1)
                                @if($url!=end($element))
                                        @continue;
                                @endif
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                         @endif


                        @endif



                    @endif
                @endforeach




            @endif
        @endforeach--}}


           {{-- @php
                   $my_pages=array();
                       foreach ($elements as $k=>$v){
                           if(is_array($v)){
                                   foreach ($v as $ks=>$vs){
                                   $my_pages[$ks]=$vs;
                                   }
                           }
                       }
                   $curr=$paginator->currentPage();
                   end($my_pages);
                   $lsat = key($my_pages);
                   reset($my_pages);

                   if($lsat <=7){
                     foreach ($my_pages as $page=>$url){
                     if($page==$curr){
                          echo "<li class='page-item active' aria-current='page'><span class='page-link'>$page</span></li>";
                     }else{
                         echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";

                       }
                     }
                   }else{

                     foreach ($my_pages as $page=>$url){
                     if($page==$curr){
                          echo "<li class='page-item active' aria-current='page'><span class='page-link'>$page</span></li>";
                     }else{
                           if($curr<=4){
                                   if($page <= 5 || $page==$lsat){
                                           if($page==$lsat){
                                           echo   "<li class='page-item disabled' aria-disabled='true'><span class='page-link'>...</span></li>";
                                           }
                                      echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";
                                   }
                           }elseif ($curr >=$lsat-3){
                                    if($page >= $lsat-4 ||$page==1){
                                        echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";
                                            if($page==1){
                                             echo   "<li class='page-item disabled' aria-disabled='true'><span class='page-link'>...</span></li>";

                                            }
                                    }

                           }else{
                                if($page ==1){
                                    echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";
                                    echo   "<li class='page-item disabled' aria-disabled='true'><span class='page-link'>...</span></li>";
                                }elseif ($page==$lsat){
                                    echo   "<li class='page-item disabled' aria-disabled='true'><span class='page-link'>...</span></li>";
                                    echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";
                                }elseif ($page==$curr-1 ||$page==$curr+1){
                                    echo "<li class='page-item'><a class='page-link' href='$url'> $page</a></li>";
                                }

                           }
                       }
                     }


                   }

                /*   foreach ($my_pages as $myk=>$myp){
                       if($myk==$curr){
                       echo "<li class='page-item active' aria-current='page'><span class='page-link'>{{ $page }}</span></li>";
                       }else{
                           if($myk==1){
                           echo "<li class='page-item'><a class='page-link' href='{{ $url }}'>{{ $page }}</a></li>";
                           }elseif ($myk==$lsat){
                           echo "<li class='page-item'><a class='page-link' href='{{ $url }}'>{{ $page }}</a></li>";
                           }

                           if($curr<=4){
                              if($myk<4 ||$myk==5){
                                echo "<li class='page-item'><a class='page-link' href='{{ $url }}'>{{ $page }}</a></li>";
                              }

                           }


                       }

                   }*/


            @endphp--}}


            @php

                echo "<li class='page-item active' aria-current='page'><span class='page-link'>第 $curr 页 &emsp;共 $lsat 页</span></li>";


            @endphp







        {{-- Next Page Link --}}
       @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>

            @if($paginator->currentPage() <= $lsat-2)
                <li class='page-item'><a class='page-link' href='{{$my_pages[$lsat]}}'>&rsaquo;&rsaquo;</a></li>

            @endif


        @else

            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>


        @endif
    </ul>
@endif
