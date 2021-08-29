import { Lead } from "./lead";

export interface ResponseHttpLead {
  status: boolean,
  errors: {
    message?: string;
  },
  data: {
    items: {
      process: Lead[],
      new: Lead[],
      done: Lead[],
    }
  }
}
