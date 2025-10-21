import type { App } from 'vue';
import DraggableDirective from '../directive/draggable-directive';

export default {
    install(app: App) {
        app.directive('draggable', DraggableDirective);
    }
};
