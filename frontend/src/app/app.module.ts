import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HTTP_INTERCEPTORS, HttpClientModule } from "@angular/common/http";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

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
import { ModalHistoryComponent } from './components/child-components/modal-history/modal-history.component';

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
    ModalHistoryComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
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
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
