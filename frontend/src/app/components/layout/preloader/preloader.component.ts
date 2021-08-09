import { Component, OnInit } from '@angular/core';

import { PreloaderService } from "../../../services/preloader/preloader.service";

@Component({
  selector: 'app-preloader',
  templateUrl: './preloader.component.html',
  styleUrls: ['./preloader.component.scss']
})
export class PreloaderComponent implements OnInit {

  constructor(
    private preloaderService: PreloaderService
  ) { }

  ngOnInit(): void {
  }

  public isPreload(): boolean {
    return this.preloaderService.getPreloaderCount() > 0;
  }
}
