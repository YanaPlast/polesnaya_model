class Review {

    html_template(item) {
        return ` <div class="item">
                    <a class="fancybox-gallery" data-fancybox="otzyvy" href="${item.src}">
                        <picture>
                            <img class="" src="${item.src}" alt=""/>
                        </picture>                    
                    </a>          
                    <p class="info"><span class="name">"${item.name}"</span>, <span class="sphere">${item.sfera}</span></p>
                </div>`;
    }

    constructor(el) {

        if (el.length) {

            this.el = el;
            this.grid = el.find('*[data-role="grid"]');



            this.count_default = 12;
            this.count_upload = 4;
            this.items = [];
            this.count = 0;

            this.load();

            $('body').on('click', '*[data-role="btn_more"]', (e) => {
                this.add(this.count_upload);
                if (this.items.length === this.count){
                    $(e.currentTarget).addClass('hidden');
                }
            });
        }
    }

    add(count_add) {

        let total = 0;

        for (let i = this.count; i <= this.items.length; i++) {
            let item = this.items[i];

            if (total === count_add) return;

            let html = this.html_template(item);

            this.grid.append(html);

            this.count++;

            total++;
        }


    }

    load() {

        $.ajax({
            url: this.el.attr('data-url'),
            success: (data) => {

                this.grid.html('');

                this.items = data;

                this.add(this.count_default);
            }
        });
    }
}

var _Review;
_Review = new Review($('*[data-role="Review"]'));