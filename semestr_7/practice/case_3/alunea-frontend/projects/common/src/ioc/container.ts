class Container {
    protected instances: Map<string, object>;
    protected classRegistry: Map<string, { new (...args: any[]): any }>;
    protected idRegistry: Map<Function, string>;

    constructor() {
        this.instances = new Map();
        this.classRegistry = new Map();
        this.idRegistry = new Map();
    }

    public set(service: object) {
        this.instances.set(Object.getPrototypeOf(service).constructor.name, service);
    }

    public get<T>(Class: { new (...args: any[]): T }): T {
        if (!this.instances.has(Class.name)) {
            throw new Error(`No binding found for ${Class.name}`);
        }
        return this.instances.get(Class.name) as T;
    }

    public setAbstract<T>(BaseClass: { new (...args: any[]): T }, service: T) {
        this.instances.set(BaseClass.name, service);
    }

    public getAbstract<T>(BaseClass: { new (...args: any[]): T }): T {
        if (!this.instances.has(BaseClass.name)) {
            throw new Error(`No abstract binding found for ${BaseClass.name}`);
        }
        return this.instances.get(BaseClass.name) as T;
    }

    public registerClass<T>(id: string, Class: { new (...args: any[]): T }) {
        this.classRegistry.set(id, Class);
        this.idRegistry.set(Class, id);
    }

    public getClass<T>(id: string): { new (...args: any[]): T } {
        const Class = this.classRegistry.get(id);
        if (!Class) {
            throw new Error(`No class registered with ID: ${id}`);
        }
        return Class;
    }

    public getClassId(Class: Function): string {
        return this.idRegistry.get(Class);
    }
}

const container = new Container();

export { container };
