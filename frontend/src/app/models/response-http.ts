export interface ResponseHttp {
  status: boolean,
  errors: {
    message?: string;
  },
  data: {
    items: any[],
    item?: any,
    number?: any,
    history?: any[],
    exist?: boolean
  }
}
