import type { DirectiveBinding } from 'vue';
import { container } from "../ioc/container";
import {StorageService} from "../service/storage-service";

const storageService = container.get(StorageService);

interface DraggableOptions {
    onUpdate?: (el: HTMLElement, percent: number) => void;
    initialPercent?: number;
    keyPrefix?: string;
}

export default {
    async mounted(el: HTMLElement, binding: DirectiveBinding<DraggableOptions>) {
        let isDragging = false;
        let startY = 0;

        const storageKey =
            (binding.value?.keyPrefix ? binding.value.keyPrefix + '.' : '') +
            'draggable.value';

        let positionYPercent: number = parseFloat(
            (await storageService.getStoragePlatform().get(storageKey)) ??
            (binding.value?.initialPercent ?? '50')
        );

        const updatePosition = async (percent: number) => {
            positionYPercent = Math.max(0, Math.min(100, percent));
            el.style.top = positionYPercent + '%';
            if (binding.value?.onUpdate) {
                binding.value.onUpdate(el, positionYPercent);
            }
            await storageService.getStoragePlatform().set(storageKey, positionYPercent);
        };

        // ---- Mouse events ----
        const onMouseDown = (event: MouseEvent) => {
            isDragging = true;
            startY = event.clientY - ((el.offsetParent?.clientHeight ?? window.innerHeight) * (positionYPercent / 100));
            window.addEventListener('mousemove', onMouseMove);
            window.addEventListener('mouseup', onMouseUp);
        };

        const onMouseMove = (e: MouseEvent) => {
            if (!isDragging) return;
            const newPosPx = e.clientY - startY;
            const newPosPercent = (newPosPx / (el.offsetParent?.clientHeight ?? window.innerHeight)) * 100;
            updatePosition(newPosPercent);
        };

        const onMouseUp = () => {
            isDragging = false;
            window.removeEventListener('mousemove', onMouseMove);
            window.removeEventListener('mouseup', onMouseUp);
        };

        // ---- Touch events ----
        const onTouchStart = (event: TouchEvent) => {
            if (event.touches.length !== 1) return;
            isDragging = true;
            startY = event.touches[0].clientY - ((el.offsetParent?.clientHeight ?? window.innerHeight) * (positionYPercent / 100));
            window.addEventListener('touchmove', onTouchMove, { passive: false });
            window.addEventListener('touchend', onTouchEnd);
        };

        const onTouchMove = (event: TouchEvent) => {
            if (!isDragging) return;
            event.preventDefault(); // чтобы не скроллился фон
            const newPosPx = event.touches[0].clientY - startY;
            const newPosPercent = (newPosPx / (el.offsetParent?.clientHeight ?? window.innerHeight)) * 100;
            updatePosition(newPosPercent);
        };

        const onTouchEnd = () => {
            isDragging = false;
            window.removeEventListener('touchmove', onTouchMove);
            window.removeEventListener('touchend', onTouchEnd);
        };

        el.addEventListener('mousedown', onMouseDown);
        el.addEventListener('touchstart', onTouchStart, { passive: false });

        // начальная установка позиции
        updatePosition(positionYPercent);
    },
};
