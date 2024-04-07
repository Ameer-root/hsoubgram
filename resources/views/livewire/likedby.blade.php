<div class="px-5 mb-4"  dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
    @if($this->likes > 0)
        {{__('Liked By')}}
        <strong>
            <a href="/{{$this->firstusername}}">{{$this->firstusername}}</a>
        </strong>
    @endif

    @if($this->likes > 1)
        {{__('and') }} <button onclick="Livewire.dispatch('openModal', { component: 'others-liked-by-modal', arguments: { postId: {{$postId}} } })"><strong>{{__('others')}}</strong></button>
    @endif
</div>
