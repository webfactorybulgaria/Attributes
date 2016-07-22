<ul class="list-attributes">
    @foreach ($items as $attribute)
    @include('attributes::public._list-item')
    @endforeach
</ul>
