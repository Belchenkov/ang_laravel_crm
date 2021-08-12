import { User } from "./user";

export interface ResponseHttpLogin {
  status: boolean,
  errors: Object,
  data: {
    user: User,
    api_token: string,
    token_type: string,
    expires_id: string
  }
}
