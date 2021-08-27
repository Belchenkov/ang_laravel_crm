import { Component, OnInit } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";

import { Lead } from "../../models/lead";
import { LeadsService } from "../../services/leads.service";

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.sass']
})
export class DashboardComponent implements OnInit {
  public newLeads: Lead[];
  public doneLeads: Lead[];
  public processingLeads: Lead[];

  public leadExpress: boolean = false;
  public leadProcess: boolean = false;
  public doneLeadQuality: boolean = false;
  public doneLeadQualityFalse: boolean = false;
  public processingLeadsProcess: boolean = false;

  constructor(
    private leadService: LeadsService,
    private toastService: MatSnackBar
  ) { }

  ngOnInit(): void {
    this.leadService.getLeads()
      .subscribe((data) => {
        this.newLeads = data.new;
        this.doneLeads = data.done;
        this.processingLeads = data.process;
      });
  }

  public openHistory(event, lead: Lead, index: number, leads: Lead[]): void {
    console.log('openHistory')
  }

}
