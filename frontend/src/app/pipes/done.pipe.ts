import { Pipe, PipeTransform } from '@angular/core';

import { Lead } from "../models/lead";

@Pipe({
  name: 'done'
})
export class DonePipe implements PipeTransform {

  transform(doneLeads: Lead[], doneLeadQuality: boolean, doneLeadQualityFalse: boolean): Lead[] {
    if (doneLeads && doneLeads.length === 0) {
      return doneLeads;
    }

    if (doneLeadQuality) {
      return doneLeads.filter((lead: Lead) => lead.is_quality_lead === doneLeadQuality);
    }

    if (doneLeadQualityFalse) {
      return doneLeads.filter((lead: Lead) => lead.is_quality_lead !== doneLeadQualityFalse);
    }

    return doneLeads;
  }
}
