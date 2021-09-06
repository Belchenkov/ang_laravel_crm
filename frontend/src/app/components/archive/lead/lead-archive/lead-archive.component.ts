import { Component, OnInit } from '@angular/core';

import { Lead } from "../../../../models/lead";
import { LeadsService } from "../../../../services/leads.service";

@Component({
  selector: 'app-lead-archive',
  templateUrl: './lead-archive.component.html',
  styleUrls: ['./lead-archive.component.sass']
})
export class LeadArchiveComponent implements OnInit {
  public page: number;
  public leads: Lead[];
  public doneLeadQuality: boolean = false;
  public doneLeadQualityFalse: boolean = false;

  constructor(
    private leadsService: LeadsService
  ) {
    this.page = 1;
    this.leads = [];
  }

  ngOnInit(): void {
    this.getLeads();
  }

  public openHistory(event: Event, lead: Lead, i: number, leads: Lead[]) {

  }

  public loadLead(): void {
    this.page++;
    this.getLeads();
  }

  private getLeads(): void {
    this.leadsService.getArchiveLeads(this.page)
      .subscribe((data: Lead[]) => {
        data.forEach((item: Lead) => {
          this.leads.push(item);
        });
      });
  }
}
