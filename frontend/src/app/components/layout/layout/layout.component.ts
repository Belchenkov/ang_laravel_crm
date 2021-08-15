import { Component, OnInit } from '@angular/core';
import { NavigationEnd, Router } from "@angular/router";
import { filter } from "rxjs/operators";

import { NavigationService } from "../../../services/navigation.service";
import { AuthService } from "../../../services/auth/auth.service";
import { Navigation } from "../../../models/navigation";

@Component({
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.scss']
})
export class LayoutComponent implements OnInit {
  public navigation: Navigation[];
  public navMenu: boolean = true;

  constructor(
    private navigationService: NavigationService,
    private router: Router,
    private authService: AuthService
  ) {
    this.router.events
      .pipe(
        filter((event: any) => event instanceof NavigationEnd)
      )
      .subscribe((url: NavigationEnd) => {
        if (url.url && url.url.indexOf('form') != -1) {
          if (this.authService.checkUser() && !this.navigation) {
            this.getMenu();
          }
        }
      });
  }

  ngOnInit(): void {
  }

  private getMenu(): void {
    this.navigationService.getNavigation().subscribe((data: Navigation[]) => {
      this.navigation = data;
    });
  }

}
