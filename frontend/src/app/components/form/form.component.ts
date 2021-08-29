import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";
import { MatSnackBar } from "@angular/material/snack-bar";

import {
  AbstractControl,
  FormControl,
  FormGroup,
  ValidationErrors,
  Validators
} from "@angular/forms";
import { Unit } from "../../models/unit";
import { Source } from "../../models/source";
import { User } from "../../models/user";
import { Lead } from "../../models/lead";
import { Task } from "../../models/task";
import { UnitsService } from "../../services/units.service";
import { SourcesService } from "../../services/sources.service";
import { LeadsService } from "../../services/leads.service";
import { TasksService } from "../../services/tasks.service";
import { UsersService } from "../../services/users.service";

@Component({
  selector: 'app-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss']
})
export class FormComponent implements OnInit {
  public form: FormGroup;
  public units: Unit[];
  public sources: Source[];
  public users: User[];
  public lead: Lead;
  public task: Task;
  public isLead: boolean;
  public addSaleCount: number = 0;

  constructor(
    private unitsService: UnitsService,
    private sourcesService: SourcesService,
    private leadsService: LeadsService,
    private tasksService: TasksService,
    private usersService: UsersService,
    private toastsService: MatSnackBar,
    private router: Router,
  ) {
    this.lead = new Lead();
    this.task = new Task();
  }

  get f() {
    return this.form.controls;
  }

  ngOnInit(): void {
    this.getUnits();
    this.getSources();
    this.getUsers();
    this.getAddSaleCount();

    this.isLead = true;

    this.form = new FormGroup({
      linkPhone: new FormGroup({
        link: new FormControl(''),
        phone: new FormControl(''),
      }, this.RequireLinkPhone()),
      source_id: new FormControl('', Validators.required),
      unit_id: new FormControl('', Validators.required),
      is_processed: new FormControl('', Validators.required),
      is_express_delivery: new FormControl('', Validators.required),
      is_add_sale: new FormControl('', Validators.required),
      text: new FormControl(''),
      responsible_id: new FormControl(''),
      isLead: new FormControl(true),
    });

    this.onChangesIsLead();
  }

  public onSubmit(): void {
    if (this.form.invalid) {
      return;
    }

    if (this.isLead) {
      // Lead
      this.lead = Object.assign(this.form.value, this.form.get('linkPhone').value);
      this.checkLead();
    } else {
      // Task
      this.task = Object.assign(this.form.value, this.form.get('linkPhone').value);
      this.storeTask();
    }

    // Clear form
    this.form.reset({
      is_processed: 0,
      is_express_delivery: 0,
      is_add_sale: 0,
      text: '',
      responsible_id: null,
      isLead: true,
    });

    Object.keys(this.form.controls).forEach((key: string) => {
      this.resetControls(this.form.get(key));
    });

    this.resetControls(this.f.linkPhone.get('link'));
    this.resetControls(this.f.linkPhone.get('phone'));
    this.resetControls(this.form);

    this.router.navigate(['/']);
  }

  private getUnits(): void {
    this.unitsService.getUnits()
      .subscribe((data: Unit[]) => {
        this.units = data;
      });
  }

  private getSources(): void {
    this.sourcesService.getSources()
      .subscribe((data: Source[]) => {
        this.sources = data;
      });
  }

  private getUsers(): void {
    this.usersService.getUsers()
      .subscribe((data: User[]) => {
        this.users = data;
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

  private onChangesIsLead(): void {
    this.form.get('isLead')
      .valueChanges
      .subscribe(val => {
        this.isLead = val;
        this.form.controls['responsible_id'].setValidators(null);

        if (!val) {
          this.form.controls['responsible_id'].setValidators([Validators.required]);
        }

        this.form.controls['responsible_id'].updateValueAndValidity();
      });
  }

  private getAddSaleCount(): void {
    this.leadsService.addSaleCount()
      .subscribe((data: number) => {
        this.addSaleCount = data;
      });
  }

  private checkLead(): void {
    this.leadsService
      .checkLead(this.lead)
      .subscribe((data) => {
        if (data.exist) {
          this.lead.id = data.item.id;
          this.updateLead();
        } else {
          this.storeLead();
        }
      });
  }

  private storeTask(): void {
    this.tasksService
      .storeTask(this.task)
      .subscribe(() => {
        this.toastsService.open('Сохранено!', 'Закрыть', {
          duration: 3000,
        });
      });
  }

  private updateLead(): void {
    this.leadsService
      .updateLead(this.lead)
      .subscribe(() => {
        this.toastsService.open('Сохранено!', 'Закрыть', {
          duration: 3000,
        });
      });
  }

  private storeLead(): void {
    this.leadsService
      .storeLead(this.lead)
      .subscribe(() => {
        this.toastsService.open('Сохранено!', 'Закрыть', {
          duration: 3000,
        });
      });
  }

  private resetControls(obj: AbstractControl) {
    obj.setErrors(null);
    obj.markAsUntouched();
    obj.markAsPristine();
  }
}
