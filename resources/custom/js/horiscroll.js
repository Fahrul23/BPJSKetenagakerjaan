const horiscroll = function(el) {
    this.x = 0;
    this.x_scroll = 0;
    
    this.touchStart = function(el) {
        el.on('touchstart', function(e) {
            const event = e.originalEvent.touches[0];
            this.x = event.clientX;
            this.x_scroll = this.scrollLeft;
        })
    }

    this.touchMove = function(el) {
        el.on('touchmove', function(e) {
            const event = e.originalEvent.touches[0];
            this.scrollLeft = this.x_scroll + (this.x - event.clientX);
        })
    }

    this.wheel = function(el) {
        el.on('wheel', function(e) {
            e.preventDefault();
            console.log(this.x_scroll)
            const event = e.originalEvent;
            let deltaX = event.deltaY;
                deltaX = Math.floor(deltaX);
            this.x_scroll = this.scrollLeft;
            this.scrollLeft = this.x_scroll + deltaX * 2;
        })
    }

    this.touchStart(el)
    this.touchMove(el)
    this.wheel(el)
}