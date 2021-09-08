import { Component, Inject, OnInit } from '@angular/core';

import { MAT_DIALOG_DATA } from "@angular/material/dialog";
import { Lead } from "../../../../models/lead";
import { LeadComment } from "../../../../models/lead-comment";
import { LeadCommentService } from "../../../../services/lead-comment.service";

@Component({
  selector: 'app-lead-archive-history',
  templateUrl: './lead-archive-history.component.html',
  styleUrls: ['./lead-archive-history.component.scss']
})
export class LeadArchiveHistoryComponent implements OnInit {
  public leadComments: LeadComment[];

  constructor(
    private leadCommentService: LeadCommentService,
    @Inject(MAT_DIALOG_DATA) public data: {
      lead: Lead
    }
  ) { }

  ngOnInit(): void {
    setTimeout(() => {
      this.getLeadComments();
    }, 10);
  }

  private getLeadComments(): void {
    this.leadCommentService
      .getComments(this.data.lead.id)
      .subscribe((data: LeadComment[]) => {
        this.leadComments = data;
      });
  }
}
