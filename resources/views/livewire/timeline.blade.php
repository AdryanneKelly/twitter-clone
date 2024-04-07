<div class="mt-10 text-white w-full text-lg">
    <button wire:click='loadMore'>Load more</button>
    @foreach ($tweets as $tweet)
        <div>
            {{ $loop->index }} - {{ $tweet->body }}
        </div>
    @endforeach

    <div class="bg-blue-500 h-10 w-10" x-data="{
        infinityScroll() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.loadMore();
                    }
                });
            }, {
                threshold: 1.0, // dispara o evento quando 100% do elemento estiver visível
                rootMargin: '100px', // disparar o evento 100px antes do elemento ficar visível
            });
            observer.observe(this.$el);
        }
    }" x-init="infinityScroll()">

    </div>
</div>
