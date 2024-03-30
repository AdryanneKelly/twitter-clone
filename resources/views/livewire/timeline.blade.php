<div class="mt-10 text-white w-full text-lg">
    <button wire:click='loadMore'>Load more</button>
    @foreach ($tweets as $tweet)
        <div>
            {{ $loop->index }} - {{ $tweet->body }}
        </div>
    @endforeach

    <div id="jeremias" x-data="{
        jeremias() {
            const observer = new IntersectionObserver((entries) => {
    
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        console.log('Intersecting');
                        @this.loadMore();
                    }
                });
            });
            observer.observe(this.$el);
        }
    }" x-init="jeremias()">
        <div wire:loading>
            Loading...
        </div>

    </div>
</div>
