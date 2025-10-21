export class CacheService {
    protected cache: Map<string, { value: any; expiration: number | null }> = new Map();

    public set(key: string, value: any, ttl: number | null = null): void {
        const expiration = ttl ? Date.now() + ttl * 1000 : null;
        this.cache.set(key, { value, expiration });
    }

    public get(key: string): any {
        const cacheEntry = this.cache.get(key);

        if (!cacheEntry) {
            return null;
        }

        if (cacheEntry.expiration !== null && Date.now() > cacheEntry.expiration) {
            this.cache.delete(key);
            return null;
        }

        return cacheEntry.value;
    }

    public remove(key: string): void {
        this.cache.delete(key);
    }

    public clear(): void {
        this.cache.clear();
    }

    public getCache(): any {
        return this.cache;
    }
}
