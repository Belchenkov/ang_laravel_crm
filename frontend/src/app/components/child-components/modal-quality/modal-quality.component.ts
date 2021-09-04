import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from "@angular/material/snack-bar";
import { MAT_BOTTOM_SHEET_DATA, MatBottomSheetRef } from "@angular/material/bottom-sheet";

import { LeadsService } from "../../../services/leads.service";
import { Lead } from "../../../models/lead";

@Component({
  selector: 'app-modal-quality',
  templateUrl: './modal-quality.component.html',
  styleUrls: ['./modal-quality.component.scss']
})
export class ModalQualityComponent implements OnInit {

  constructor(
    private leadService: LeadsService,
    private toastService: MatSnackBar,
    private dialogRef: MatBottomSheetRef<ModalQualityComponent>,

    @Inject(MAT_BOTTOM_SHEET_DATA) public data: {
      lead: Lead,
      doneLeads: Lead[],
    }
  ) { }

  ngOnInit(): void {
  }

  addQuality(): void {
    this.leadService
      .addQuality(this.data.lead)
      .subscribe((data: Lead) => {
        this.toastService.open('Сохранено!', 'Закрыть', {
          duration: 2000,
        });

        let idx: number = null;
        this.data.doneLeads.forEach((item: Lead, i: number) => {
          if (item.id === data.id) {
            idx = i;
          }
        });

        if (idx) {
          this.data.doneLeads.splice(idx, 1, data);
        }

        this.dialogRef.dismiss();
      });
  }

  closeModal(): void {
    this.dialogRef.dismiss();
  }

}
