import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";
import { MAT_DIALOG_DATA, MatDialogRef } from "@angular/material/dialog";
import {
  AbstractControl,
  FormControl,
  FormGroup,
  ValidationErrors,
  Validators
} from "@angular/forms";

import { LeadsService } from "../../../services/leads.service";
import { UnitsService } from "../../../services/units.service";
import { SourcesService } from "../../../services/sources.service";
import { Lead } from "../../../models/lead";
import { Unit } from "../../../models/unit";
import { Source } from "../../../models/source";

@Component({
  selector: 'app-modal-new-lead',
  templateUrl: './modal-new-lead.component.html',
  styleUrls: ['./modal-new-lead.component.scss']
})
export class ModalNewLeadComponent implements OnInit {
  public form: FormGroup;
  public units: Unit[];
  public sources: Source[];
  public lead : Lead;

  constructor(
    private leadService: LeadsService,
    private toastService: MatSnackBar,
    private unitsService: UnitsService,
    private sourcesService: SourcesService,
    private dialogRef: MatDialogRef<ModalNewLeadComponent>,

    @Inject(MAT_DIALOG_DATA) public data: {
      leads: Lead[]
    }
  ) { }

  get f() {
    return this.form.controls;
  }

  ngOnInit(): void {
    setTimeout(() => {
      this.getUnits();
      this.getSources();
    });

    this.form = new FormGroup({
      linkPhone: new FormGroup({
        link: new FormControl(''),
        phone: new FormControl(''),
      }, this.RequireLinkPhone()),
      source_id: new FormControl('', Validators.required),
      unit_id: new FormControl('', Validators.required),
      is_processed: new FormControl(false, Validators.required),
      is_express_delivery: new FormControl(false, Validators.required),
      is_add_sale: new FormControl(false, Validators.required),
      text: new FormControl(''),
    });
  }

  onSubmit() {
    if (this.form.invalid) {
      return;
    }

    this.lead = new Lead();

    // lead
    this.lead = Object.assign(this.form.value, this.form.get('linkPhone').value);
    this.checkLead();

    this.form.reset({
      is_processed : false,
      is_express_delivery :false,
      is_add_sale : false,
      text : "",
    });


    Object.keys(this.form.controls).forEach(key => {
      this.resetControls(this.form.get(key));
    });

    this.resetControls(this.f.linkPhone.get('link'));
    this.resetControls(this.f.linkPhone.get('phone'));
    this.resetControls(this.form);

    this.dialogRef.close();
  }

  resetControls (obj: AbstractControl) {
    obj.setErrors(null) ;
    obj.markAsUntouched();
    obj.markAsPristine();
  }


  checkLead() {
    this.leadService.checkLead(this.lead).subscribe((data) => {
      if(data.exist) {
        this.lead.id = data.item.id;
        this.updateLead();
      }
      else {
        this.storeLead();
      }
    });
  }
  private storeLead(): void {
    this.leadService.storeLead(this.lead)
      .subscribe((data : Lead) => {
      this.toastService.open("Сохранено","Закрыть", {
        duration: 2000
      });
      this.data.leads.push(data);
    })
  }
  private updateLead(): void {
    this.leadService.updateLead(this.lead)
      .subscribe((data) => {
      this.toastService.open("Сохранено","Закрыть", {
        duration: 2000
      });
    })
  }

  private getUnits() {
    this.unitsService.getUnits()
      .subscribe((data: Unit[]) => {
        this.units = data;
      });
  }

  private getSources() {
    this.sourcesService.getSources()
      .subscribe((data: Source[]) => {
        this.sources = data;
      });
  }

  private RequireLinkPhone(): Object | null {
    return (group: FormGroup): ValidationErrors => {
      const link = group.controls['link'];
      const phone = group.controls['phone'];

      if ((!link.value && !phone.value) || (link.value && phone.value)) {
        link.setErrors({ RequireLinkPhone: true });
        phone.setErrors({ RequireLinkPhone: true });
        return { RequireLinkPhone: true };
      } else {
        link.setErrors(null);
        phone.setErrors(null);
        return null;
      }
    };
  }
}
