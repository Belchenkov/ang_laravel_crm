import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatSidenavModule } from "@angular/material/sidenav";
import { MatToolbarModule } from "@angular/material/toolbar";
import { MatButtonModule } from "@angular/material/button";
import { MatIconModule } from "@angular/material/icon";
import { MatListModule } from "@angular/material/list";
import { MatProgressSpinnerModule } from "@angular/material/progress-spinner";
import { MatFormFieldModule } from "@angular/material/form-field";
import { MatInputModule } from "@angular/material/input";
import { MatSnackBarModule } from "@angular/material/snack-bar";

const Modules: any[] = [
  MatSidenavModule,
  MatToolbarModule,
  MatButtonModule,
  MatIconModule,
  MatProgressSpinnerModule,
  MatListModule,
  MatFormFieldModule,
  MatInputModule,
  MatSnackBarModule,
];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    Modules
  ],
  exports: [
    Modules
  ]
})
export class MaterialModule { }
