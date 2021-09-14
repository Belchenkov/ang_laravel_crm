import { Component, OnInit } from '@angular/core';
import { MatDialog, MatDialogRef } from "@angular/material/dialog";
import { MatSnackBar } from "@angular/material/snack-bar";
import { MatTableDataSource } from "@angular/material/table";

import { SourcesService } from "../../services/sources.service";
import { Source } from "../../models/source";
import { ModalSourcesComponent } from "../child-components/modal-sources/modal-sources.component";

@Component({
  selector: 'app-sources',
  templateUrl: './sources.component.html',
  styleUrls: ['./sources.component.scss']
})
export class SourcesComponent implements OnInit {
  public sources: Source[];
  public source: Source;
  public dataSource = new MatTableDataSource<Source>();

  constructor(
    private sourcesService: SourcesService,
    private modalService: MatDialog,
    private toastService: MatSnackBar,
    private ref: MatDialogRef<ModalSourcesComponent>,
  ) { }

  ngOnInit(): void {
    this.getSources();
  }

  public openSourceModal(): void {
    this.ref = this.modalService.open(ModalSourcesComponent, {
      data: {
        sources: this.sources,
      },
      width: '80%',
    });

    this.ref.componentInstance
      .onChange
      .subscribe(() => {
        this.dataSource.data = this.sources;
      });
  }

  public editSource(source: Source, i: number): void {
    this.source = source;
    this.ref = this.modalService.open(ModalSourcesComponent, {
      data: {
        source: this.source,
        sources: this.sources,
      },
      width: '80%',
    });

    this.ref.componentInstance
      .onChange
      .subscribe(() => {
        this.dataSource.data = this.sources;
      });
  }

  public deleteSource(source: Source, idx: number): void {
    if (confirm("Удалить?")) {
      if (idx) {
        this.sourcesService.deleteSource(this.dataSource.data[idx])
          .subscribe(() => {
            this.sources.splice(idx, 1);
            this.dataSource.data = this.sources;

            this.toastService.open("Удалено", "Закрыть", {
              duration: 2000
            });
          });
      }
    }
  }

  private getSources() {
    this.sourcesService.getSources()
      .subscribe((data: Source[]) => {
        this.sources = data;
        this.dataSource.data = this.sources;
      });
  }

}
