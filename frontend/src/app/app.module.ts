import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HTTP_INTERCEPTORS, HttpClientModule } from "@angular/common/http";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { AppRoutingModule } from './app-routing.module';
import { MaterialModule } from "./modules/material/material.module";
import { AppComponent } from './app.component';
import { LayoutComponent } from './components/layout/layout/layout.component';
import { NavigationComponent } from './components/layout/navigation/navigation.component';
import { PreloaderComponent } from './components/layout/preloader/preloader.component';
import { SidenavListComponent } from './components/layout/sidenav-list/sidenav-list.component';
import { PreloaderInterceptor } from "./interceptors/preloader.interceptor";

@NgModule({
  declarations: [
    AppComponent,
    LayoutComponent,
    NavigationComponent,
    PreloaderComponent,
    SidenavListComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: PreloaderInterceptor,
      multi: true,
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
