export interface ResponseHttp {
  status: boolean,
  errors: Object,
  data: {
    items: any[],
    item?: any,
    number?: any,
    history?: any[],
    exist?: boolean
  }
}
