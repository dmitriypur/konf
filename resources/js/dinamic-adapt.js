"use strict";

class DynamicAdapt {
    constructor(type) {
        this.type = type;
        this.objects = [];
        this.daClassname = "_dynamic_adapt_";
        this.nodes = [];
        this.mediaQueries = [];
        this.init();
    }

    init() {
        this.nodes = document.querySelectorAll("[data-da]");
        if (this.nodes.length === 0) return;

        this.fillObjects();
        this.arraySort(this.objects);
        this.createMediaQueries();
        this.addMediaListeners();
    }

    fillObjects() {
        for (let i = 0; i < this.nodes.length; i++) {
            const node = this.nodes[i];
            const data = node.dataset.da.trim();
            const dataArray = data.split(",");
            
            const object = {
                element: node,
                parent: node.parentNode,
                destination: document.querySelector(dataArray[0].trim()),
                breakpoint: dataArray[1] ? dataArray[1].trim() : "767",
                place: dataArray[2] ? dataArray[2].trim() : "last",
                index: this.indexInParent(node.parentNode, node)
            };

            if (object.destination) {
                this.objects.push(object);
            }
        }
    }

    createMediaQueries() {
        this.mediaQueries = this.objects
            .map(item => `(${this.type}-width: ${item.breakpoint}px),${item.breakpoint}`)
            .filter((item, index, self) => self.indexOf(item) === index);
    }

    addMediaListeners() {
        this.mediaQueries.forEach(media => {
            const mediaSplit = media.split(',');
            const matchMedia = window.matchMedia(mediaSplit[0]);
            const mediaBreakpoint = mediaSplit[1];
            
            const objectsFilter = this.objects.filter(item => 
                item.breakpoint === mediaBreakpoint
            );

            const mediaHandler = () => {
                this.mediaHandler(matchMedia, objectsFilter);
            };

            matchMedia.addEventListener('change', mediaHandler);
            this.mediaHandler(matchMedia, objectsFilter);
        });
    }

    mediaHandler(matchMedia, objects) {
        if (matchMedia.matches) {
            objects.forEach(object => {
                object.index = this.indexInParent(object.parent, object.element);
                this.moveTo(object.place, object.element, object.destination);
            });
        } else {
            for (let i = objects.length - 1; i >= 0; i--) {
                const object = objects[i];
                if (object.element.classList.contains(this.daClassname)) {
                    this.moveBack(object.parent, object.element, object.index);
                }
            }
        }
    }

    moveTo(place, element, destination) {
        element.classList.add(this.daClassname);
        
        if (place === 'last' || place >= destination.children.length) {
            destination.insertAdjacentElement('beforeend', element);
            return;
        }
        
        if (place === 'first') {
            destination.insertAdjacentElement('afterbegin', element);
            return;
        }
        
        destination.children[place].insertAdjacentElement('beforebegin', element);
    }

    moveBack(parent, element, index) {
        element.classList.remove(this.daClassname);
        
        if (parent.children[index] !== undefined) {
            parent.children[index].insertAdjacentElement('beforebegin', element);
        } else {
            parent.insertAdjacentElement('beforeend', element);
        }
    }

    indexInParent(parent, element) {
        return Array.from(parent.children).indexOf(element);
    }

    arraySort(arr) {
        if (this.type === "min") {
            arr.sort((a, b) => {
                if (a.breakpoint === b.breakpoint) {
                    if (a.place === b.place) return 0;
                    if (a.place === "first" || b.place === "last") return -1;
                    if (a.place === "last" || b.place === "first") return 1;
                    return a.place - b.place;
                }
                return a.breakpoint - b.breakpoint;
            });
        } else {
            arr.sort((a, b) => {
                if (a.breakpoint === b.breakpoint) {
                    if (a.place === b.place) return 0;
                    if (a.place === "first" || b.place === "last") return 1;
                    if (a.place === "last" || b.place === "first") return -1;
                    return b.place - a.place;
                }
                return b.breakpoint - a.breakpoint;
            });
        }
    }
}

// Инициализация при загрузке DOM
function initDynamicAdapt() {
    new DynamicAdapt("max");
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDynamicAdapt);
} else {
    initDynamicAdapt();
}
