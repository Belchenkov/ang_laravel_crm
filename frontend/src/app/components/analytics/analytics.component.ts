import { Component, OnInit } from '@angular/core';

import { LeadsService } from "../../services/leads.service";
import { Analytic } from "../../models/analytic";
import { environment } from "../../../environments/environment";

@Component({
  selector: 'app-analytics',
  templateUrl: './analytics.component.html',
  styleUrls: ['./analytics.component.scss']
})
export class AnalyticsComponent implements OnInit {
  public dateStart: Date;
  public dateEnd: Date;
  public analyticsData: Analytic[];
  public path: string = environment.apiUrl;

  constructor(
    private leadService: LeadsService
  ) { }

  ngOnInit(): void {
    this.dateStart = new Date(
      new Date().getFullYear(),
      new Date().getMonth(),
      1
    );
    this.dateEnd = new Date(
      new Date().getFullYear(),
      new Date().getMonth() + 1,
      0
    );

    this.getAnalytics();
  }

  public getAnalytics(): void {
    this.leadService
      .getAnalytics(this.dateHelper(this.dateStart), this.dateHelper(this.dateEnd))
      .subscribe((data: Analytic[]) => {
        this.analyticsData = data;
      });
  }

  public dateHelper(date: Date): string {
    return date ? `${date.getDate()}.${(date.getMonth() + 1)}.${date.getFullYear()}` : '';
  }
}
