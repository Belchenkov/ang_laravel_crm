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

  public dateCheck(createdAt: number, num: number, type: string): boolean {
    if (type === 'less') {
      return this.dateHelper('h', new Date(createdAt * 1000), new Date()) < num;
    }

    if (type === 'more') {
      return this.dateHelper('h', new Date(createdAt * 1000), new Date()) > num;
    }

    return false;
  }

  public timeStr(fromDate: any): string {
    const resultDate = this.dateHelper('h', new Date(fromDate * 1000), new Date());
    let result = '';

    if (resultDate < 24) {
      result = ' до 24 часов';
    } else if (resultDate > 24 && resultDate < 48) {
      result = ' 24-48 часа';
    } else if (resultDate > 48 && resultDate < 72) {
      result = ' 48-72 часа';
    } else {
      result = ' 72 часа и более';
    }

    return result;
  }

  private dateHelper(datePart: string, fromDate: any, today: any): number {
    const diff = today - fromDate;
    const divideBy = {
      w: 604800000,
      d: 86400000,
      h: 3600000,
      n: 60000,
      s: 1000
    };

    datePart = datePart.toLocaleLowerCase();

    return Math.floor(diff / divideBy[datePart]);
  }
}
