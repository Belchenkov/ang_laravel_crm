import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from "@angular/forms";
import { MatSnackBar } from "@angular/material/snack-bar";

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

    this.isLead = true;

    this.form = new FormGroup({
      linkPhone: new FormGroup({
        link: new FormControl(''),
        phone: new FormControl(''),
      }, this.RequireLinkPhone()),
      sourceId: new FormControl('', Validators.required),
      unitId: new FormControl('', Validators.required),
      isProcessed: new FormControl('', Validators.required),
      isExpressDelivery: new FormControl('', Validators.required),
      isAddSale: new FormControl('', Validators.required),
      text: new FormControl(''),
      responsibleId: new FormControl(''),
      isLead: new FormControl(true),
    });

    this.onChangesIsLead();
  }

  public onSubmit() {

  }

  private getUnits() {
    this.unitsService.getUnits()
      .subscribe((data: Unit[]) => {
        this.units = data;
      });
  }

  private getSources() {

  }

  private getUsers() {

  }

  private RequireLinkPhone() {
    return undefined;
  }

  private onChangesIsLead() {

  }
}
