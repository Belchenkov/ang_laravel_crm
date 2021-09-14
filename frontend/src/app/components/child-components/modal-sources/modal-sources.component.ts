import { Component, EventEmitter, Inject, OnInit, Output } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";
import { MAT_DIALOG_DATA, MatDialogRef } from "@angular/material/dialog";
import { FormControl, FormGroup } from "@angular/forms";

import { SourcesService } from "../../../services/sources.service";
import { Source } from "../../../models/source";

@Component({
  selector: 'app-modal-sources',
  templateUrl: './modal-sources.component.html',
  styleUrls: ['./modal-sources.component.scss']
})
export class ModalSourcesComponent implements OnInit {
  @Output() onChange = new EventEmitter();
  form: FormGroup;
  source: Source;

  constructor(
    private sourcesService: SourcesService,
    private toastService: MatSnackBar,
    private ref: MatDialogRef<ModalSourcesComponent>,
    @Inject(MAT_DIALOG_DATA) public data: {
      source: Source,
      sources: Source[]
    }
  ) {
    this.source = this.data.source;
    if (!this.source) {
      this.source = new Source();
    }
  }

  get f() {
    return this.form.controls;
  }

  ngOnInit(): void {
    this.form = new FormGroup({
      title: new FormControl(this.source.title)
    });
  }

  public onSubmit(): void {
    if (this.form.invalid) {
      return;
    }

    this.source = Object.assign(this.source, this.form.value);

    if (this.source.id) {
      this.updateSource();
    } else {
      this.saveSource();
    }

    this.form.reset();
    this.ref.close();
  }

  private updateSource(): void {
    this.sourcesService
      .updateSource(this.source)
      .subscribe((source: Source) => {
        this.data.sources.forEach((item: Source, idx: number) => {
          if (item.id === source.id) {
            this.data.sources[idx] = source;
          }
        });

        this.toastService.open('Сохранено!', 'Закрыть', {
          duration: 2000,
        });

        this.onChange.emit();
      });
  }

  private saveSource(): void {
    this.sourcesService
      .saveSource(this.source)
      .subscribe((source: Source) => {
        this.data.sources.push(source);

        this.toastService.open('Сохранено!', 'Закрыть', {
          duration: 2000,
        });

        this.onChange.emit();
      });
  }
}
