import {SerializerService} from "../service/serializer-service";
import {AbstractStoragePlatform} from "./abstract-storage-platform";

export class LocalStoragePlatform extends AbstractStoragePlatform {
    constructor(
        protected serializerService: SerializerService
    ) {
        super();}

    public async set(key: string, value: any): Promise<void> {
        try {
            const serialized = this.serializerService.serialize(value);
            localStorage.setItem(key, serialized);
        } catch (error) {
            return Promise.reject(error);
        }
    }

    public async get(key: string): Promise<any | null> {
        try {
            const item = localStorage.getItem(key);
            return item ? this.serializerService.deserialize(item) : null;
        } catch (error) {
            return Promise.reject(error);
        }
    }

    public async hasKey(key: string): Promise<boolean> {
        try {
            return localStorage.getItem(key) !== null;
        } catch (error) {
            return Promise.reject(error);
        }
    }

    public async remove(key: string): Promise<void> {
        try {
            localStorage.removeItem(key);
        } catch (error) {
            return Promise.reject(error);
        }
    }
}