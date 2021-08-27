import { Pipe, PipeTransform } from '@angular/core';

import { Lead } from "../models/lead";

@Pipe({
  name: 'newLead'
})
export class NewLeadPipe implements PipeTransform {

  transform(newLeads: Lead[], leadProcess: boolean, leadExpress: boolean): Lead[] {
    if (newLeads && newLeads.length === 0) {
      return newLeads;
    }

    let tmp: Lead[] = newLeads;

    if (leadProcess) {
      tmp = newLeads.filter((lead: Lead) => Boolean(lead.is_processed) === leadProcess);
    }

    if (leadExpress) {
      tmp = newLeads.filter((lead: Lead) => Boolean(lead.is_express_delivery) === leadExpress);
    }

    return tmp;
  }
}
