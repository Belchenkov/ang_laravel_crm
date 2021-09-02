import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";
import { FormControl, FormGroup } from "@angular/forms";
import { MAT_DIALOG_DATA } from "@angular/material/dialog";

import { LeadsService } from "../../../services/leads.service";
import { UnitsService } from "../../../services/units.service";
import { SourcesService } from "../../../services/sources.service";
import { UsersService } from "../../../services/users.service";
import { LeadCommentService } from "../../../services/lead-comment.service";
import { StatusService } from "../../../services/status.service";
import { Lead } from "../../../models/lead";
import { Status } from "../../../models/status";
import { LeadComment } from "../../../models/lead-comment";

@Component({
  selector: 'app-modal-history',
  templateUrl: './modal-history.component.html',
  styleUrls: ['./modal-history.component.scss']
})
export class ModalHistoryComponent implements OnInit {
  form: FormGroup;
  statuses: Status[];
  leadComments: LeadComment[];

  constructor(
    private leadService: LeadsService,
    private toastService: MatSnackBar,
    private unitService: UnitsService,
    private sourceService: SourcesService,
    private leadCommentService: LeadCommentService,
    private usersService: UsersService,
    private statusService: StatusService,

    @Inject(MAT_DIALOG_DATA) public data: {
      newLeads: Lead[],
      processingLeads: Lead[],
      doneLeads: Lead[],
      lead: Lead,
      leads: Lead[],
    }
  ) { }

  get f() {
    return this.form.contains;
  }

  ngOnInit(): void {
    if (!this.data.lead) {
      this.data.lead = new Lead();
    }

    setTimeout(() => {
      this.getStatuses();
      this.getLeadComments();
    }, 10);

    this.form = new FormGroup({
      text: new FormControl(''),
      status_id: new FormControl(this.data.lead.status_id),
    });
  }

  private getStatuses(): void {
    this.statusService
      .getStatuses()
      .subscribe((data: Status[]) => {
          this.statuses = data;
      });
  }

  private getLeadComments(): void {
    this.leadCommentService
      .getComments(this.data.lead.id)
      .subscribe((data: LeadComment[]) => {
        this.leadComments = data;
      });
  }
}
