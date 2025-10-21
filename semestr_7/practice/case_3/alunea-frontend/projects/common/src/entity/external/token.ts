export class Token {
    constructor(
        protected value: string,
        protected tokenId: string,
        protected userId: string,
        protected iat: number,
        protected exp: number
    ) {
    }

    public getValue(): string {
        return this.value;
    }

    public setValue(value: string) {
        this.value = value;
    }

    public getTokenId(): string {
        return this.tokenId;
    }

    public setTokenId(tokenId: string) {
        this.tokenId = tokenId;
    }

    public getUserId(): string {
        return this.userId;
    }

    public setUserId(userId: string) {
        this.userId = userId;
    }

    public getIat(): number {
        return this.iat;
    }

    public setIat(iat: number) {
        this.iat = iat;
    }

    public getExp(): number {
        return this.exp;
    }

    public setExp(exp: number) {
        this.exp = exp;
    }
}
