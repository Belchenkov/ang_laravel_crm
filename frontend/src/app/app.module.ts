import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HTTP_INTERCEPTORS, HttpClientModule } from "@angular/common/http";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatDatepickerModule } from "@angular/material/datepicker";
import { MatNativeDateModule } from "@angular/material/core";

import { AppRoutingModule } from './app-routing.module';
import { MaterialModule } from "./modules/material/material.module";
import { AppComponent } from './app.component';
import { LayoutComponent } from './components/layout/layout/layout.component';
import { NavigationComponent } from './components/layout/navigation/navigation.component';
import { PreloaderComponent } from './components/layout/preloader/preloader.component';
import { SidenavListComponent } from './components/layout/sidenav-list/sidenav-list.component';
import { PreloaderInterceptor } from "./interceptors/preloader.interceptor";
import { FormComponent } from './components/form/form.component';
import { LoginComponent } from './components/login/login.component';
import { AuthInterceptor } from "./interceptors/auth.interceptor";
import { LogoutInterceptor } from "./interceptors/logout.interceptor";
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { NewLeadPipe } from './pipes/new-lead.pipe';
import { ProcessingPipe } from './pipes/processing.pipe';
import { DonePipe } from './pipes/done.pipe';
import { EventPipe } from './pipes/event.pipe';
import { ModalHistoryComponent } from './components/child-components/modal-history/modal-history.component';
import { ModalQualityComponent } from './components/child-components/modal-quality/modal-quality.component';
import { ModalNewLeadComponent } from './components/child-components/modal-new-lead/modal-new-lead.component';
import { LeadArchiveComponent } from './components/archive/lead/lead-archive/lead-archive.component';
import { LeadArchiveHistoryComponent } from './components/archive/lead/lead-archive-history/lead-archive-history.component';
import { AnalyticsComponent } from './components/analytics/analytics.component';
import { SourcesComponent } from './components/sources/sources.component';
import { ModalSourcesComponent } from './components/child-components/modal-sources/modal-sources.component';
import { MatDialogRef } from "@angular/material/dialog";

@NgModule({
  declarations: [
    AppComponent,
    LayoutComponent,
    NavigationComponent,
    PreloaderComponent,
    SidenavListComponent,
    FormComponent,
    LoginComponent,
    DashboardComponent,
    NewLeadPipe,
    ProcessingPipe,
    DonePipe,
    ModalHistoryComponent,
    EventPipe,
    ModalQualityComponent,
    ModalNewLeadComponent,
    LeadArchiveComponent,
    LeadArchiveHistoryComponent,
    AnalyticsComponent,
    SourcesComponent,
    ModalSourcesComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    MatDatepickerModule,
    MatNativeDateModule,
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: PreloaderInterceptor,
      multi: true,
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true,
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: LogoutInterceptor,
      multi: true,
    },
    {
      provide: MatDialogRef,
      useValue: {}
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
