import { Component, OnInit } from '@angular/core';

import { NavigationService } from "../../../services/navigation.service";
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
    private navigationService: NavigationService
  ) { }

  ngOnInit(): void {
    this.getMenu();
  }

  private getMenu(): void {
    this.navigationService.getNavigation().subscribe((data: Navigation[]) => {
      this.navigation = data;
    });
  }

}
