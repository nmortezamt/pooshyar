    <div class="product_search_form radius_input search_form_btn">

        <div class="input-group">
            <input class="form-control" placeholder="جستجو محصول" type="text" id="search" onclick="showBox()" onblur="hideBox()" wire:model.debounce.200ms='search'>
        </div>

            {{-- <div id="search-box">
                @if (strlen($search) >= 3 && ! count($results))
                <div>هیچ نتیجه ای برای شما یافت نشد</div>
                @endif
            @foreach ($results as $group=>$entries)
            @if ($group == 'product')
            <div>دوره ها</div>
            @foreach ($entries as $entry)

              <div>



                  <a href="course-details/course{{ $value }}/{{ $link }}">



                      <p>{{ $entry['title'] }}</p>

                      <img src="/uploads/{{ $entry['img'] }}" alt="" width="150px">
                  </a>
              </div>

              @endforeach

              @elseif($group == 'article')
              <div>مقاله ها</div>
              @foreach ($entries as $entry)
              <div>
                  @php
                  foreach($entry['link'] as $link => $value){
                  $link = $value;
                  }
                  @endphp

                  @foreach ($entry['id'] as $id => $value)
                  <a href="article-{{ $value }}/{{ $link }}">
                      @endforeach


                      @foreach ($entry['title'] as $name => $value)
                      <p>{{ $value }}</p>
                      @endforeach

                      @foreach ($entry['img'] as $img => $value)
                      <img src="/storage/{{ $value }}" alt="" width="150px">
                      @endforeach
                  </a>
              </div>

              @endforeach
              @endif


              @endforeach

            </div> --}}

</div>
{{-- <script>
    function showBox() {
    var searchBox = document.getElementById("search-box");
    searchBox.style.display = "block";
    }

    function hideBox() {
    var searchBox = document.getElementById("search-box");
    setTimeout(function() {
        searchBox.style.display = "none";
    }, 200);
    }

</script> --}}
