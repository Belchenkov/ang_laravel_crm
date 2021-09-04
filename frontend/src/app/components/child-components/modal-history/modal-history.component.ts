import { Component, EventEmitter, Inject, OnInit, Output } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";
import { FormControl, FormGroup } from "@angular/forms";
import {
  MAT_DIALOG_DATA,
  MatDialogRef
} from "@angular/material/dialog";

import { LeadsService } from "../../../services/leads.service";
import { UnitsService } from "../../../services/units.service";
import { SourcesService } from "../../../services/sources.service";
import { UsersService } from "../../../services/users.service";
import { LeadCommentService } from "../../../services/lead-comment.service";
import { StatusService } from "../../../services/status.service";
import { Lead } from "../../../models/lead";
import { Status, STATUSES } from "../../../models/status";
import { LeadComment } from "../../../models/lead-comment";

@Component({
  selector: 'app-modal-history',
  templateUrl: './modal-history.component.html',
  styleUrls: ['./modal-history.component.scss']
})
export class ModalHistoryComponent implements OnInit {
  @Output() onQuality = new EventEmitter<Lead>();

  form: FormGroup;
  statuses: Status[];
  leadComments: LeadComment[];
  leadComment: LeadComment;

  constructor(
    private leadService: LeadsService,
    private toastService: MatSnackBar,
    private leadCommentService: LeadCommentService,
    private usersService: UsersService,
    private statusService: StatusService,
    private dialogRef: MatDialogRef<ModalHistoryComponent>,

    @Inject(MAT_DIALOG_DATA) public data: {
      newLeads: Lead[],
      processingLeads: Lead[],
      doneLeads: Lead[],
      lead: Lead,
      leads: Lead[],
      index: number,
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

  onSubmit() {
    if (this.form.invalid) {
      return;
    }

    this.storeLeadComment();
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

  private storeLeadComment() {
    this.leadComment = Object.assign(this.form.value);
    this.leadComment.lead_id = this.data.lead.id;

    this.leadCommentService
      .storeLeadComment(this.leadComment)
      .subscribe((data: Lead) => {
        this.dialogRef.close();
        this.toastService.open("Сохранено!", "Закрыть", {
          duration: 2000
        });

        const newLeadResult: Lead = data;
        this.data.leads.splice(this.data.index, 1);

        switch (newLeadResult.status_id) {
          case STATUSES.NEW:
            this.data.newLeads.push(newLeadResult);
            break;
          case STATUSES.PROCESS:
            this.data.processingLeads.push(newLeadResult);
            break;
          case STATUSES.DONE:
            this.data.doneLeads.push(newLeadResult);
            this.onQuality.emit(newLeadResult);
            break;
          default:
            break;
        }
      });
  }
}
