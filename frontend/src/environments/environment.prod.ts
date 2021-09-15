import { clientId, clientSecret } from "../../client.json";

export const environment = {
  production: true,
  apiUrl: 'http://localhost:8083',
  auth: {
    clientSecret,
    clientId
  }
};
